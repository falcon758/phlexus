<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;

use Phalcon\Mvc\Model as MvcModel;

trait Model {

    private MvcModel $model;

    private array $allowedFields = [];

    private function getModel(): MvcModel {
        return $this->model;
    }

    private function setModel(MvcModel $model) {
        $this->model = $model;
    }

    private function getAllowedFields(): array {
        return $this->allowedFields;
    }

    private function setAllowedFields(array $allowedFields) {
        $this->allowedFields = $allowedFields;
    }

    private function modelToFields(): array {
        $reflection = new \ReflectionClass($this->getModel());

        $fields = $reflection->getProperties(\ReflectionProperty::IS_PUBLIC);

        return $fields;
    }
}