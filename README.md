ヘルスケアシステムにおける患者情報管理システムの一部として、Node.jsを使用してクリーンアーキテクチャに基づいたシンプルな実装例を提供します。この例では、患者の基本情報を取得し、更新する機能を中心に構築します。

### 構成要素

1. **エンティティ（Entities）**: 患者のモデル。
2. **ユースケース（Use Cases）**: 患者データの取得と更新。
3. **インターフェースアダプター（Interface Adapters）**: APIエンドポイントとデータアクセス層。
4. **フレームワークとドライバ（Frameworks and Drivers）**: Express.jsとMongoDB。

### プロジェクト構成

以下のようにディレクトリを構成します。

```
/healthcare-system
    /src
        /entities
            Patient.js
        /use_cases
            GetPatient.js
            UpdatePatient.js
        /interface_adapters
            /controllers
                PatientController.js
            /repositories
                PatientRepository.js
        /frameworks_drivers
            /web
                server.js
            /database
                mongo.js
    /node_modules
    /package.json
```

### 各コンポーネントの詳細

#### エンティティ

```javascript
// src/entities/Patient.js

class Patient {
    constructor(id, name, age, medicalRecord) {
        this.id = id;
        this.name = name;
        this.age = age;
        this.medicalRecord = medicalRecord;
    }
}
module.exports = Patient;
```

#### ユースケース

```javascript
// src/use_cases/GetPatient.js

class GetPatient {
    constructor(patientRepository) {
        this.patientRepository = patientRepository;
    }

    async execute(patientId) {
        return await this.patientRepository.findById(patientId);
    }
}

module.exports = GetPatient;
```

```javascript
// src/use_cases/UpdatePatient.js

class UpdatePatient {
    constructor(patientRepository) {
        this.patientRepository = patientRepository;
    }

    async execute(patientId, updateData) {
        return await this.patientRepository.update(patientId, updateData);
    }
}

module.exports = UpdatePatient;
```

#### インターフェースアダプター

```javascript
// src/interface_adapters/controllers/PatientController.js

const GetPatient = require('../../use_cases/GetPatient');
const UpdatePatient = require('../../use_cases/UpdatePatient');
const PatientRepository = require('../repositories/PatientRepository');

class PatientController {
    async getPatient(req, res) {
        const getPatient = new GetPatient(new PatientRepository());
        const patient = await getPatient.execute(req.params.id);
        res.json(patient);
    }

    async updatePatient(req, res) {
        const updatePatient = new UpdatePatient(new PatientRepository());
        const patient = await updatePatient.execute(req.params.id, req.body);
        res.json(patient);
    }
}

module.exports = PatientController;
```

#### フレームワークとドライバ

```javascript
// src/frameworks_drivers/web/server.js

const express = require('express');
const PatientController = require('../../interface_adapters/controllers/PatientController');

const app = express();
app.use(express.json());

const patientController = new PatientController();

app.get('/patients/:id', patientController.getPatient);
app.put('/patients/:id', patientController.updatePatient);

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`Server running on port ${PORT}`);
});
```

### 実行

この構成により、患者情報の取得と更新がエンティティからフレームワーク層まで独立しており、各層は互いに影響を与えずに機能します。Node.jsとExpressを使用してAPIサーバーを構築し、クリーンアーキテクチャの原則に従ってコードを整理しました。これにより、将来的な拡張や他のシステムとの統合も容易に行えます。
