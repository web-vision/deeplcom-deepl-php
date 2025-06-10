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
  RELEASE_VERSION='1.0.0' ; \
  git checkout main && \
  git fetch --all && \
  git pull --rebase && \
  git checkout ${RELEASE_BRANCH} && \
  git pull --rebase && \
  git checkout -b prepare-release-${RELEASE_VERSION} && \
  composer require --dev "typo3/tailor" && \
  ./.Build/bin/tailor set-version ${RELEASE_VERSION} && \
  composer remove --dev "typo3/tailor" && \
  git add . && \
  git commit -m "[TASK] Prepare release ${RELEASE_VERSION}" && \
  git push --set-upstream origin prepare-release-${RELEASE_VERSION} && \
  gh pr create --fill-verbose --base ${RELEASE_BRANCH} --title "[TASK] Prepare release for ${RELEASE_VERSION} on ${RELEASE_BRANCH}" && \
  git checkout main && \
  git branch -D prepare-release-${RELEASE_VERSION}
```

Check pull-request and the pipeline run.

**Merge approved pull-request and push version tag**

> Set `RELEASE_PR_NUMBER` with the pull-request number of the preparation pull-request.
> Set `RELEASE_BRANCH` to branch release should happen, for example: 'main' (same as in previous step).
> Set `RELEASE_VERSION` to release version working on, for example: `0.1.4` (same as in previous step).

```shell
RELEASE_BRANCH='main' ; \
RELEASE_VERSION='1.0.0' ; \
RELEASE_PR_NUMBER='123' ; \
  git checkout main && \
  git fetch --all && \
  git pull --rebase && \
  gh pr checkout ${RELEASE_PR_NUMBER} && \
  gh pr merge -rd ${RELEASE_PR_NUMBER} && \
  git tag ${RELEASE_VERSION} && \
  git push --tags
```

This triggers the `on push tags` workflow (`publish.yml`) which creates the upload package,
creates the GitHub release and also uploads the release to the TYPO3 Extension Repository.

