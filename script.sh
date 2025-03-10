#!/bin/bash
(crontab -l | grep -v "/usr/bin/php /home/bhojmandu/public_html/artisan dm:disbursement") | crontab -

(crontab -l | grep -v "/usr/bin/php /home/bhojmandu/public_html/artisan restaurant:disbursement") | crontab -

