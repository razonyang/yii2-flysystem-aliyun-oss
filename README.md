Aliyun OSS Adapter for Yii2 Flysystem
=====================================

[![Build Status](https://travis-ci.org/razonyang/yii2-flysystem-aliyun-oss.svg?branch=master)](https://travis-ci.org/razonyang/yii2-flysystem-aliyun-oss)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/razonyang/yii2-flysystem-aliyun-oss/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/razonyang/yii2-flysystem-aliyun-oss/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/razonyang/yii2-flysystem-aliyun-oss/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/razonyang/yii2-flysystem-aliyun-oss/?branch=master)
[![Latest Stable Version](https://img.shields.io/packagist/v/razonyang/yii2-flysystem-aliyun-oss.svg)](https://packagist.org/packages/razonyang/yii2-flysystem-aliyun-oss)
[![Total Downloads](https://img.shields.io/packagist/dt/razonyang/yii2-flysystem-aliyun-oss.svg)](https://packagist.org/packages/razonyang/yii2-flysystem-aliyun-oss)
[![LICENSE](https://img.shields.io/github/license/razonyang/yii2-flysystem-aliyun-oss)](LICENSE)


Installation
------------

```
composer require razonyang/yii2-flysystem-aliyun-oss
```

Usage
-----

Configuration:

```php
return [
    'components' => [
        'aliyunOss' => [
            'class' => \RazonYang\Yii2\Flysystem\AliyunOssFilesystem::class,
            'accessKeyId' => '',
            'accessKeySecret' => '',
            'endpoint' => '', // endpoint
            'isCName' => false,
            'bucket' => '', // bucket name
        ],
    ],
];
```
