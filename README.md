# TYPO3 Extension `(deeplcom) DeepL PHP`

|                  | URL                                                         |
|------------------|-------------------------------------------------------------|
| **Repository:**  | https://github.com/web-vision/deeplcom-deepl-php            |
| **Read online:** | -                                                           |
| **TER:**         | https://extensions.typo3.org/extension/deeplcom_deeplphp/   |

## Description

Shared library extension to share the [(deeplcom) deepl php library](https://github.com/DeepLcom/deepl-php)
across extensions.

Main goal of this extension is having a shared extension released in the
TYPO3 Extension Repository for classic mode installations and would not
have been needed for pure composer based extensions and setups.

## Versioning

Extension version aligns to the [(deeplcom) deepl php library](https://github.com/DeepLcom/deepl-php)
versions which means that this extension has no own version. Version does not
start from the start of library and is kicked-off with one of the recent versions.

## Installation

Install with your flavour:

* [TER](https://extensions.typo3.org/extension/deeplcom_deeplphp/)
* Extension Manager
* composer

We prefer composer installation:

```bash
composer require 'web-vision/deeplcom-deepl-php':'1.*.*@dev'
```

## Set `deeplcom/deepl-php` version

> [!IMPORTANT]
> It's important to use these commands to have the bundled contrib folder
> providing the correct version, otherwise wrong version would be shipped
> and used in classic mode instances.

```bash
PACKAGE_VERSION='1.18.0' ; \
  composer require "deeplcom/deepl-php:${PACKAGE_VERSION}" && \
  composer require -d contrib "deeplcom/deepl-php:${PACKAGE_VERSION}" && \
  composer config "extra"."typo3/cms"."version" "${PACKAGE_VERSION}-dev" && \
  echo "${PACKAGE_VERSION}-dev" > VERSION && \
  sed -i "s/^  PACKAGE_VERSION.*/  PACKAGE_VERSION=\"${DEV_VERSION}\"/" README.md && \
  git add . && \
  git commit -m "[TASK] Set 'deeplcom/deepl-php' to '${PACKAGE_VERSION}'"
```

## Create a release (maintainers only)

Prerequisites:

* git binary
* ssh key allowed to push new branches to the repository
* GitHub command line tool `gh` installed and configured with user having permission to create pull requests.

**Prepare release locally**

> Set `RELEASE_BRANCH` to branch release should happen, for example: 'main'.
> Set `RELEASE_VERSION` to release version working on, for example: '1.0.0'.

```shell
echo '>> Prepare release pull-request' ; \
  RELEASE_BRANCH='main' ; \
  RELEASE_VERSION="1.18.0"
  DEV_VERSION="1.18.1"
  git checkout main && \
  git fetch --all && \
  git pull --rebase && \
  git checkout ${RELEASE_BRANCH} && \
  git pull --rebase && \
  tailor set-version ${RELEASE_VERSION} && \
  composer config "extra"."typo3/cms"."version" "${RELEASE_VERSION}" && \
  echo "${RELEASE_VERSION}" > VERSION && \
  sed -i "s/^  RELEASE_VERSION.*/  RELEASE_VERSION=\"${RELEASE_VERSION}\"/" README.md && \
  sed -i "s/^  DEV_VERSION.*/  DEV_VERSION=\"${DEV_VERSION}\"/" README.md && \
  git add . && \
  git commit -m "[RELEASE] ${RELEASE_VERSION}" && \
  git tag ${RELEASE_VERSION} && \
  git push && \
  git push --tags && \
  tailor set-version ${DEV_VERSION} && \
  composer config "extra"."typo3/cms"."version" "${DEV_VERSION}-dev" && \
  echo "${DEV_VERSION}-dev" > VERSION && \
  git add . && \
  git commit -m "[TASK] Set dev version ${DEV_VERSION}-dev" && \
  git push
```
