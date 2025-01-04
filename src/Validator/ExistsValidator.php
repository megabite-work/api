<?php

namespace App\Validator;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ExistsValidator extends ConstraintValidator
{
    public function __construct(private EntityManagerInterface $em) {}

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (null === $value || '' === $value) {
            return;
        }

        $qb = $this->em->createQueryBuilder()
            ->select('e')
            ->from($constraint->entity, 'e')
            ->where('e.' . $constraint->field . ' = :value')
            ->setParameter('value', $value);

        foreach ($constraint->conditions as $field => $condition) {
            if (is_array($condition) && isset($condition['operator'], $condition['value'])) {
                $qb->andWhere("e.$field {$condition['operator']} :$field")
                    ->setParameter($field, $condition['value']);
            } else {
                continue;
            }
        }

        $entity = $qb->getQuery()->getOneOrNullResult();

        if (!$entity) {
            $violation = $this->context->buildViolation($constraint->message)
                ->setParameter('{{ field }}', $constraint->field)
                ->setParameter('{{ value }}', $value)
                ->setParameter('{{ entity }}', substr($constraint->entity, strrpos($constraint->entity, '\\') + 1));
                
                if (!$this->context->getPropertyName()) {
                    $violation->atPath($this->context->getMetadata()->getConstraints()[0]->field);
                }
                
                $violation->addViolation();
        }
    }
}
