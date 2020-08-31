#!/bin/sh
gpg --quiet --batch --yes --decrypt --passphrase="$TEST_KEY" \
--output $PWD/.env  $PWD/values/test-stage/value.yml.gpg
