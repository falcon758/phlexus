<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic;

use Phalcon\Mvc\Model as MvcModel;
use Phalcon\Mvc\Model\Resultset\Simple;

/**
 * Trait Model
 *
 * @package Phlexus\Modules\Generic
 */
trait Model {

    private MvcModel $model;

    private array $viewFields = [];

    /**
     * Get Model
     *
     * @return MvcModel The Model instance
     */
    private function getModel(): MvcModel {
        return $this->model;
    }

    /**
     * Set Form
     * 
     * @param MvcModel The Model instance
     * 
     * @return void
     */
    private function setModel(MvcModel $model) {
        $this->model = $model;
    }

    /**
     * Get View Fields
     *
     * @return array The View Fields array
     */
    private function getViewFields(): array {
        return $this->viewFields;
    }

    /**
     * Set View Fields
     * 
     * @param array The View Fields array
     * 
     * @return void
     */
    private function setViewFields(array $fields) {
        $this->viewFields = $fields;
    }

    /**
     * Parse Fields
     *
     * @return array Parsed fields
     */
    private function parseFields(array $fields): array {
        $model = $this->getModel();

        $reflection = new \ReflectionClass($model);

        foreach($fields as $key => $field) {
            $fieldName = $field['name'];
            if(!$reflection->hasProperty($fieldName)) {
                unset($fields[$key]);
                continue;
            }

            if(isset($field['related'])) {
                $fields[$key]['related'] = ($field['related'])::find();
            }
        }

        return $fields;
    }

    /**
     * Get Related Field
     *
     * @return array Related Model Fields
     */
    private function getRelatedFields(): array {
        $model = $this->getModel();

        $relations = $model->getModelsManager()->getHasOne($model);

        $related = [];

        foreach($relations as $relation) {
            $field = $relation->getFields();
            $options = $relation->getOptions();

            $related[$field] = $options['alias'];
        }

        return $related;
    }

    /**
     * Translate Related Field
     * 
     * @param Simple The Simple instance
     *
     * @return array Translated Related Fields (if column is named 'name')
     */
    private function translateRelatedFields(Simple $records): array {
        $related = $this->getRelatedFields();

        if(count($related) === 0) {
            return $records;
        }

        $fields = [];

        foreach($records as $key => $record) {
            $fields[$key] = [];

            foreach($related as $field => $table) {
                if(isset($record->{$table}->name)) {
                    $fields[$key][$field] = $record->{$table}->name;
                }
            }
        }

        return $fields;
    }
}