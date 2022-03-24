#!/usr/bin/env bash
apt-get update
apt-get install -y python-software-properties
add-apt-repository -y ppa:ondrej/php5
apt-get update
apt-get install -y apache2
export DEBIAN_FRONTEND=noninteractive
apt-get -q -y install mysql-server
mysqladmin -u root password 1rootdev
apt-get install -y php5
apt-get install -y php5-gd php5-curl php5-mysql php5-mcrypt
a2enmod rewrite
service apache2 stop
if ! [ -L /var/www/html ]; then     
    rm -rf /var/www/html
    ln -fs /vagrant /var/www/html
fi
sudo service apache2 start
