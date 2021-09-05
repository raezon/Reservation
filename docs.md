Here we put all the commands executed to create this app:

# create the basic template
composer create-project hunwalk/yii2-basic-firestarter ClicangoEvent --prefer-dist

# remove A conventional commits from composer.json update depencies
composer update

# create .env file from .env.example
cp .env.example .env

# execute migrations
php yii migrate-user
php yii migrate-rbac
php yii migrate

# install php intl-extension