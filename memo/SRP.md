## 単一責任の法則について

単一責任のクラスを作る上で、どれくらいの粒度に分ければいいのかと考えたい。
何でもかんでも分けると、コードの保守性が逆に落ちるし、処理が分散しすぎて管理性が落ちると考えているので。


```PHP
class StripeApiClient
{
    private $client;

    public function __construct(StripeClient $client)
    {
        $this->client = $client;
    }

    public function attachPaymentMethodToCustomer(string $paymentMethodId, string $customerId): void
    {
        $this->client->paymentMethods->attach(
            $paymentMethodId,
            ['customer' => $customerId]
        );
    }

    public function createPaymentIntent(array $params): PaymentIntent
    {
        return $this->client->paymentIntents->create($params);
    }

    public function retrievePaymentIntent(string $id): PaymentIntent
    {
        return $this->client->paymentIntents->retrieve($id);
    }

    public function createRefund(array $params): Refund
    {
        return $this->client->refunds->create($params);
    }

    public function retrieveRefund(string $refundId): Refund
    {
        return $this->client->refunds->retrieve($refundId);
    }
}
```

例えばこれ。
APIのやり取りを完全に分離している。

```PHP
class StripeCreditService
{
    private $stripeApiClient;
    private $paymentProcessor;
    private $refundProcessor;

    public function __construct(
        StripeApiClient $stripeApiClient,
        PaymentProcessor $paymentProcessor,
        RefundProcessor $refundProcessor
    ) {
        $this->stripeApiClient = $stripeApiClient;
        $this->paymentProcessor = $paymentProcessor;
        $this->refundProcessor = $refundProcessor;
    }

    public function getToken(int $id): string
    {
        return B2cOrderPaymentToken::findOrFail($id)->token_id;
    }

    public function checkoutOrder(string $token, array $payload): array
    {
        return $this->paymentProcessor->processPayment($payload, $token);
    }

    public function getOrder(string $stripeOrderId): PaymentIntent
    {
        return $this->stripeApiClient->retrievePaymentIntent($stripeOrderId);
    }

    public function refund(string $paymentIntentId, ?float $amount, int $currencyListId): Refund
    {
        return $this->refundProcessor->processRefund($paymentIntentId, $amount, $currencyListId);
    }

    public function getRefund(string $refundId): Refund
    {
        return $this->refundProcessor->getRefund($refundId);
    }
}
```

それをこのようなserviceクラスで呼ぶと、1行だけのメソッドがたくさん増える。
なので、このように1つのserviceクラスのプライベートメソッドとしてAPIの部分を分離したりする粒度もあり。
この辺はプロジェクトの規模と、他に似たような機能がどれくらい発生しそうかで決定するのが良さそう。
少人数だと責任度合いは曖昧で、大規模だときっちりやるのもありか（どうしても設計をガチガチにすると工数がかかる。）

```PHP
{
    private $client;

    public function __construct(StripeClient $client)
    {
        $this->client = $client;
    }

    // 公開メソッド
    public function processPayment(array $params): PaymentIntent
    {
        // 支払い処理のロジック
        return $this->createPaymentIntent($params);
    }

    // プライベートメソッド
    private function createPaymentIntent(array $params): PaymentIntent
    {
        return $this->client->paymentIntents->create($params);
    }

    private function retrievePaymentIntent(string $id): PaymentIntent
    {
        return $this->client->paymentIntents->retrieve($id);
    }

    // 他のメソッド...
}
```
