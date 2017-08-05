# justice-OJ frontend

### Install

```
# php composer global require "fxp/composer-asset-plugin:^1.3.1"

# php composer install

# php init --env=Development --overwrite=All

# php yii serve --docroot="your_web_root"
```

### RabbitMQ

```
# yum install -y rabbitmq-server

# systemctl start rabbitmq-server

# rabbitmq-plugins enable rabbitmq_management

# rabbitmqctl add_user justice <PASSWORD>
# rabbitmqctl set_user_tags justice administrator
# rabbitmqctl set_permissions -p / justice ".*" ".*" ".*"
```
