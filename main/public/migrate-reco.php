<?php

use Tbd\Main\FeatureFlags\EnvOverrider;
use Tbd\Main\FeatureFlags\FeatureFlag;
use Tbd\Main\FeatureFlags\InMemoryFeatureFlags;

require __DIR__ . '/../vendor/autoload.php';

$initialFlags = require __DIR__ . '/../src/Flags.php';
$envOverrider = new EnvOverrider();
$featureFlags = new InMemoryFeatureFlags($envOverrider->overrideFlags($initialFlags));
FeatureFlag::setFeatureFlags($featureFlags);


if (!$featureFlags->isEnabled("create_impression_on_product_lookup"))
{
    echo "no elo";die;
}


$test = new \Tbd\Main\Recommendations\RecommendationsService('http://127.0.0.1:8182/');
//$test->getRecommendations(1);
for ($i = 0; $i <140; $i++) {
    $test->createImpression(2);
}

$app = new \Tbd\Main\Application();
$app->run();
