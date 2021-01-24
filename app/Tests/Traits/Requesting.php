<?php

declare(strict_types=1);

namespace App\Tests\Traits;

use Illuminate\Http\Request;
use KrzysztofRewak\Larahat\Helpers\SimpleRequesting;
use PHPUnit\Framework\Assert;

trait Requesting
{
    use SimpleRequesting;

    protected Request $request;

    /**
     * @Given a user is requesting :url
     * @Given a user is requesting :url using :method method
     */
    public function aUserIsRequesting(string $url, string $method = Request::METHOD_GET): void
    {
        $this->request = Request::create($url, $method);
    }

    /**
     * @When a request is sent
     */
    public function aRequestIsSent(): void
    {
        $this->request($this->request);
    }

    /**
     * @Then a response status code should be :code
     */
    public function aResponseStatusCodeShouldBe(int $code): void
    {
        Assert::assertEquals($code, $this->response->getStatusCode());
    }

    /**
     * @Given a request body contains :key equal :value
     */
    public function aRequestBodyContainsEqual(string $key, string $value): void
    {
        $this->request[$key] = $value;
    }
}
