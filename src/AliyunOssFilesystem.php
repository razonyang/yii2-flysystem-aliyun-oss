<?php
namespace RazonYang\Yii2\Flysystem;

use Aliyun\Flysystem\AliyunOss\AliyunOssAdapter;
use OSS\OssClient;
use creocoder\flysystem\Filesystem;
use yii\base\InvalidArgumentException;

/**
 * AliyunOssFilesystem
 *
 * @property string $accessKeyId access key ID.
 * @property string $accessKeySecret access key secret.
 * @property string $endpoint endpoint.
 * @property bool $isCName whether the endpoint is your cname domain.
 * @property null|string $securityToken security token.
 * @property string $bucket bucket name.
 * @property string $prefix prefix.
 * @property array $options options.
 */
class AliyunOssFilesystem extends Filesystem
{
    /**
     * @var string $accessKeyId access key ID.
     */
    private $accessKeyId;

    /**
     * Gets access key ID.
     *
     * @return string
     */
    public function getAccessKeyId(): string
    {
        return $this->accessKeyId;
    }

    /**
     * Sets access key ID.
     *
     * @param string $id
     */
    public function setAccessKeyId(string $id): void
    {
        $this->accessKeyId = $id;
    }

    /**
     * @var string $accessKeySecret access key secret.
     */
    private $accessKeySecret;

    /**
     * Sets access key secret.
     *
     * @return string
     */
    public function getAccessKeySecret(): string
    {
        return $this->accessKeySecret;
    }

    /**
     * Sets access key secret.
     *
     * @param string $secret
     */
    public function setAccessKeySecret(string $secret): void
    {
        $this->accessKeySecret = $secret;
    }

    /**
     * @var string $endpoint
     */
    private $endpoint;

    /**
     * Gets endpoint.
     *
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * Sets endpoint.
     *
     * @param string $endpoint
     */
    public function setEndpoint(string $endpoint): void
    {
        $this->endpoint = $endpoint;
    }

    /**
     * @var bool $isCName
     */
    private $isCName = false;

    /**
     * Returns a bool value indicates that whether the endpoint is your custom domain.
     *
     * @return bool
     */
    public function getIsCName(): bool
    {
        return $this->isCName;
    }

    /**
     * Sets a bool value indicates that whether the endpoint is your custom domain.
     *
     * @param bool $value
     */
    public function setIsCName(bool $value): void
    {
        $this->isCName = $value;
    }

    private $securityToken;

    /**
     * Gets security token.
     *
     * @return string
     */
    public function getSecurityToken(): ?string
    {
        return $this->securityToken;
    }

    /**
     * Sets security token.
     *
     * @param string $token
     */
    public function setSecurityToken(string $token): void
    {
        $this->securityToken = $token;
    }

    /**
     * @var string $bucket bucket name.
     */
    private $bucket;

    /**
     * Gets bucket name.
     *
     * @return string
     */
    public function getBucket(): string
    {
        return $this->bucket;
    }

    /**
     * Sets bucket name.
     *
     * @param string $bucket
     */
    public function setBucket(string $bucket): void
    {
        $this->bucket = $bucket;
    }

    private $prefix;

    /**
     * Gets prefix.
     *
     * @return null|string
     */
    public function getPrefix(): ?string
    {
        return $this->prefix;
    }

    /**
     * Sets prefix.
     *
     * @param string $prefix
     */
    public function setPrefix(string $prefix): void
    {
        $this->prefix = $prefix;
    }

    /**
     * @var array $options
     */
    private $options = [];

    /**
     * Gets options.
     *
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * Sets options.
     *
     * @param array $options
     */
    public function setOptions(array $options): void
    {
        $this->options = $options;
    }

    public function init()
    {
        foreach (['accessKeyId', 'accessKeySecret', 'bucket', 'endpoint'] as $name) {
            if (empty($this->$name)) {
                throw new InvalidArgumentException($name . ' is required');
            }
        }

        parent::init();
    }

    private $adapter;

    protected function prepareAdapter()
    {
        if ($this->adapter === null) {
            $this->adapter = new AliyunOssAdapter($this->getClient(), $this->bucket, $this->prefix, $this->options);
        }

        return $this->adapter;
    }

    private $client;

    protected function getClient(): OssClient
    {
        if ($this->client === null) {
            $this->client = new OssClient($this->accessKeyId, $this->accessKeySecret, $this->endpoint, $this->isCName, $this->securityToken);
        }

        return $this->client;
    }
}
