<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_PARAMETER | \Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE | \Attribute::TARGET_FUNCTION)]
class Exists extends Constraint
{
    public string $message = 'The {{ entity }} with {{ field }} {{ value }} does not exist.';
    public string $entity;
    public string $field = 'id';
    public array $conditions = [];

/*     conditions: [
        'price' => ['operator' => '>', 'value' => 100],
        'status' => ['operator' => '=', 'value' => 'active'],
    ], */

    public function __construct(
        string $entity,
        ?string $field = null,
        array $conditions = [],
        ?string $message = null,
        ?array $groups = null,
        $payload = null,
        array $options = []
    ) {
        parent::__construct($options, $groups, $payload);

        $this->entity = $entity;
        $this->conditions = $conditions;
        $this->message = $message ?? $this->message;
        $this->field = $field ?? $this->field;;
    }
}
