# 功能与接口说明


## 1. 用户登录

### 1.1 描述

登录的目的是将当前用户与服务器中的记录对应起来。由于无法直接通过前端获取微信号，故需要前端通过`wx.login()`获取`code`，具体参见[官方文档](https://shimo.im/docs/R6K6WyYRJcRTCHtY)。由于`code`有效期仅5分钟，故需要从后端获取长期性的身份凭证，即`openid`，并存入缓存。在请求账单等信息时，需要将`openid`传给后端。

### 1.2 获取OpenID接口

#### 1.2.1 请求地址

`https://api.sunxiaochuan258.com/ChatAccounting/getOpenID`

#### 1.2.2 请求方式

`GET`

#### 1.2.3 请求参数

| 属性 | 类型   | 说明                   |
| ---- | ------ | ---------------------- |
| code | string | `wx.login()`获取的code |

#### 1.2.4 返回值

返回json数据包，形如：

```json
{
    "status": "",
    "OpenID": ""
}
```

| 属性   | 类型   | 说明           |
| ------ | ------ | -------------- |
| status | string | 请求是否成功   |
| OpenID | string | 获取到的OpenID |

`status`的可能值：

| 值            | 含义     |
| ------------- | -------- |
| success       | 成功     |
| missing_param | 参数缺失 |
| failed        | 失败     |



## 2. 聊天

### 2.1 描述

与用户进行闲聊，对用户发出的消息予以回复。

### 2.2 聊天接口

#### 2.2.1 请求地址

`https://api.sunxiaochuan258.com/ChatAccounting/chat`

#### 2.2.2 请求方式

`GET`

#### 2.2.3 请求参数

| 属性 | 类型   | 说明           |
| ---- | ------ | -------------- |
| msg  | string | 用户发送的消息 |

#### 2.2.4 返回值

返回json数据包，形如：

```json
{
    "status": "",
    "msg": ""
}
```

| 属性   | 类型   | 说明         |
| ------ | ------ | ------------ |
| status | string | 请求是否成功 |
| msg    | string | 回复的消息   |

`status`的可能值：

| 值            | 含义     |
| ------------- | -------- |
| success       | 成功     |
| missing_param | 参数缺失 |
| failed        | 失败     |



## 3. 记账

### 3.1 描述

对用户的消费信息进行分类记载、统计。

### 3.2 记账接口

#### 3.2.1 请求地址

`https://api.sunxiaochuan258.com/ChatAccounting/accounting`

#### 3.2.2 请求方式

`GET`

#### 3.2.3 请求参数

| 属性  | 类型   | 说明                                |
| ----- | ------ | ----------------------------------- |
| openid   | string | 用户的OpenID                        |
| item  | string | 消费条目                            |
| type  | string | 消费类型                            |
| price | float  | 消费金额                            |

`type`的可取值：

| 值            | 含义     |
| ------------- | -------- |
| meal          | 餐饮美食 |
| clothing      | 服饰美容 |
| living        | 生活日用 |
| payment       | 充值缴费 |
| commuting     | 交通出行 |
| communication | 通讯物流 |
| leisure       | 休闲生活 |
| health        | 医疗保健 |
| education     | 图书教育 |
| traveling     | 酒店旅行 |
| other         | 其他消费 |

#### 3.2.4 返回值

返回json数据包，形如：

```json
{
    "status": "",
    "msg": ""
}
```

| 属性   | 类型   | 说明         |
| ------ | ------ | ------------ |
| status | string | 请求是否成功 |
| msg    | string | 回复的消息   |

`status`的可能值：

| 值            | 含义     |
| ------------- | -------- |
| success       | 成功     |
| missing_param | 参数缺失 |
| invalid       | 无权访问 |
| failed        | 失败     |



## 4. 查账

### 4.1 描述

查询用户的消费列表，或查询某一时间段各个类目的消费金额。

### 4.2 消费列表获取接口

#### 4.2.1 请求地址

`https://api.sunxiaochuan258.com/ChatAccounting/inquiry/list`

#### 4.2.2 请求方式

`GET`

#### 4.2.3 请求参数

| 属性   | 类型   | 说明         |
| ------ | ------ | ------------ |
| openid | string | 用户的OpenID |

#### 4.2.4 返回值

返回json数据包，形如：

```json
{
    "status": "",
    "data": [{
        "item": "",
        "type": "",
        "price": "",
        "date": ""
    }, ...]
}
```

| 属性         | 类型   | 说明                             |
| ------------ | ------ | -------------------------------- |
| status       | string | 请求是否成功                     |
| data         | array  | 消费列表，按时间由近到远排序     |
| data[].item  | string | 消费条目                         |
| data[].type  | string | 消费类型                         |
| data[].price | float  | 消费金额                         |
| data[].date  | string | 消费时间，形如`2020-07-09 11:55` |

`status`的可能值：

| 值            | 含义     |
| ------------- | -------- |
| success       | 成功     |
| missing_param | 参数缺失 |
| not_exist     | 无结果  |
| invalid       | 无权访问 |
| failed        | 失败     |

`data[].type`的可能值：

| 值            | 含义     |
| ------------- | -------- |
| meal          | 餐饮美食 |
| clothing      | 服饰美容 |
| living        | 生活日用 |
| payment       | 充值缴费 |
| commuting     | 交通出行 |
| communication | 通讯物流 |
| leisure       | 休闲生活 |
| health        | 医疗保健 |
| education     | 图书教育 |
| traveling     | 酒店旅行 |
| other         | 其他消费 |

### 4.3 消费统计接口

#### 4.3.1 请求地址

`https://api.sunxiaochuan258.com/ChatAccounting/inquiry/statistic`

#### 4.3.2 请求方式

`GET`

#### 4.3.3 请求参数

| 属性   | 类型   | 是否必须 | 说明                    |
| ------ | ------ | -------- | ----------------------- |
| openid | string | 是       | 用户的OpenID            |
| month  | string | 否       | 统计月份，形如`2020-07` |

#### 4.3.4 返回值

返回json数据包，形如：

```json
{
    "status": "",
    "data": [{
        "type": "",
        "price": ""
    }, ...]
}
```

| 属性         | 类型   | 说明                         |
| ------------ | ------ | ---------------------------- |
| status       | string | 请求是否成功                 |
| data         | array  | 结果列表，按金额从大到小排序 |
| data[].type  | string | 消费类型                     |
| data[].price | float  | 消费金额                     |

`status`的可能值：

| 值            | 含义     |
| ------------- | -------- |
| success       | 成功     |
| missing_param | 参数缺失 |
| invalid       | 无权访问 |
| not_exist     | 无结果  |
| failed        | 失败     |

`data.type`的可能值：

| 值            | 含义     |
| ------------- | -------- |
| meal          | 餐饮美食 |
| clothing      | 服饰美容 |
| living        | 生活日用 |
| payment       | 充值缴费 |
| commuting     | 交通出行 |
| communication | 通讯物流 |
| leisure       | 休闲生活 |
| health        | 医疗保健 |
| education     | 图书教育 |
| traveling     | 酒店旅行 |
| other         | 其他消费 |



## 5. 偏好设置

### 5.1 描述

设置记账机器人的性格属性、头像（之后开发）、自定义问答（之后开发）。

### 5.2 偏好设置接口

#### 5.2.1 请求地址

`https://api.sunxiaochuan258.com/ChatAccounting/preferences`

#### 5.2.2 请求类型

`GET`

#### 5.2.3 请求参数

| 属性        | 类型   | 是否必须 | 说明         |
| ----------- | ------ | -------- | ------------ |
| openid      | string | 是       | 用户的OpenID |
| personality | string | 否       | 机器人性格   |

`personality`的可取值：

| 值       | 含义 |
| -------- | ---- |
| tsundere | 傲娇 |
| kawaii   | 可爱 |
| zuan     | 祖安 |
| random   | 随机 |

#### 5.2.4 返回值

返回json数据包，形如：

```json
{
    "status": ""
}
```

`status`的可能值：

| 值            | 含义     |
| ------------- | -------- |
| success       | 成功     |
| missing_param | 参数缺失 |
| invalid       | 无权访问 |
| failed        | 失败     |