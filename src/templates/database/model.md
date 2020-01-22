<?php

declare(strict_types=1);

namespace {{namespace}};

use manchenkov\yii\database\ActiveRecord;

class {{class}} extends ActiveRecord
{
    /**
     * Data validation rules
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
}