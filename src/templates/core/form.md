<?php

declare(strict_types=1);

namespace {{namespace}};

use manchenkov\yii\data\Form;

final class {{class}} extends Form
{
    /**
     * Form validation rules
     * @return array
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * Additional behaviors to data processing
     * @return array
     */
    public function behaviors(): array
    {
        return [];
    }

    /**
     * Attributes translation
     * @return array
     */
    public function attributeLabels(): array
    {
        return [];
    }

    public function handle()
    {
        // TODO: form data processing
    }
}