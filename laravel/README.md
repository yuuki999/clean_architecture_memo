# 概要
アーキテクチャやlaravelの仕様をキャッチアップするためのPJ

## laravelのディレクトリ配置について
0からプロジェクトを立ち上げる場合は、どのようにするかある程度の型を持っておきたい。
業務の場合は、プロジェクトの内容によって適宜変更すること。


## テストの仕方
### ユニットテスト作成
```
php artisan make:test PaymentGatewayTest --unit
```

### ユニットテストの実行(単体テスト)
```
php artisan test --filter=PaymentGatewayTest
```

### フィーチャーテストの作成
```
php artisan make:test PaymentProcessTest
```

### フィーチャーテストの実行（結合テスト）
```
php artisan test --filter=PaymentProcessTest
```

### 全てのテスト実行
```
php artisan test
```

### PHPUnitの主要メソッド

```
1. assertTrue($condition): 条件が true かチェック
2. assertFalse($condition): 条件が false かチェック
3. assertEquals($expected, $actual): 期待値と実際の値が等しいかチェック
4. assertNotEquals($expected, $actual): 期待値と実際の値が異なるかチェック
5. assertNull($variable): 変数が null かチェック
6. assertNotNull($variable): 変数が null でないかチェック
7. assertEmpty($variable): 変数が空かチェック
8. assertNotEmpty($variable): 変数が空でないかチェック
9. assertCount($expectedCount, $haystack): 配列やコレクションの要素数をチェック
10. assertContains($needle, $haystack): 配列やコレクションに特定の要素が含まれているかチェック
11. assertInstanceOf($expectedClass, $object): オブジェクトが特定のクラスのインスタンスかチェック
12. assertFileExists($filename): ファイルが存在するかチェック
13. assertGreaterThan($expected, $actual): 実際の値が期待値より大きいかチェック
14. assertLessThan($expected, $actual): 実際の値が期待値より小さいかチェック
15. assertStringContainsString($needle, $haystack): 文字列が特定の部分文字列を含むかチェック
```
