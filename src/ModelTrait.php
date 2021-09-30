<?php

namespace AgenterLab\Uid;

trait ModelTrait
{
   /**
     * Boot function from Laravel.
     */
    protected static function bootModelTrait()
    {
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()}) && $model->incrementing === false) {
                $model->{$model->getKeyName()} = self::getUid();
            }
        });
        
    }

    /**
     * Get Uid
     * 
     * @return int
     */
    public static function getUid(): int
    {
        return app(\AgenterLab\Uid\Uid::class)->create();
    }
}