<?php
declare(strict_types=1);

namespace LinkedList;

abstract class Uuid
{
    /**
     * @var string
     */
    private $value;

    /**
     * @param string|null $value
     * @throws \RuntimeException
     */
    public function __construct(string $value = null)
    {
        if ($value === null) {
            try {
                $value = $this->generate();
            }
            catch (\Throwable $throwable) {
                throw new \RuntimeException('Could not create UUID');
            }
        }

        $this->value = $value;
    }

    public function asString()
    {
        return $this->value;
    }

    /**
     * @return string
     * @throws \Exception
     */
    private function generate(): string
    {
        if (file_exists('/proc/sys/kernel/random/uuid')) {
            return file_get_contents('/proc/sys/kernel/random/uuid');
        }

        return $this->createUuid(random_bytes(16));
    }

    private function createUuid($data): string
    {
        assert(strlen($data) == 16, "Invalid random string length");

        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}