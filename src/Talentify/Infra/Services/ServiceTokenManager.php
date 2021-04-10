<?php


namespace Talentify\Infra\Services;


use DateInterval;
use DateTime;
use Exception;
use Firebase\JWT\JWT;
use stdClass;
use Talentify\Domain\Services\ServiceTokenManagerInterface;

class ServiceTokenManager implements ServiceTokenManagerInterface
{

    private string $secret;
    private int $secondsOfLife = 86400;

    /**
     * ServiceTokenManager constructor.
     * @param string $secret
     * @param int $secondsOfLife
     */
    public function __construct(string $secret, int $secondsOfLife = 86400)
    {
        $this->secret = $secret;
        $this->secondsOfLife = $secondsOfLife;
    }

    /**
     * Create token
     * @throws Exception
     */
    public function create(array $data): string
    {
        $date = new DateTime();
        $criadoEm = $date->getTimestamp();
        $date->add(new DateInterval(
                sprintf('PT%sS', $this->secondsOfLife))
        );
        return JWT::encode([
            'data' => $data,
            'iat' => $criadoEm,
            'exp' => $date->getTimestamp(),
            'iss' => null,
        ], $this->secret);
    }

    /**
     * @param string $token token
     * @return null|stdClass
     */
    public function decode(string $token): ?stdClass
    {
        try {
            $decoded = JWT::decode($token, $this->secret, ['HS256']);
            if (isset($decoded->data)) {
                return $decoded->data;
            }
        } catch (Exception $ex) {
            return null;
        }
        return null;
    }
}
