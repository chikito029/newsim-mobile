<?php

function customize_single_level_collection($model_collection, ...$ignored_keys) {
    $custom_json = [];

    foreach ($model_collection as $model) {
        $custom_json [] = $model = collect($model)->forget($ignored_keys);
    }

    return $custom_json;
}