# Contributing to deeplcom-deepl-php

This extension packages the official DeepL PHP SDK
[`deeplcom/deepl-php`](https://github.com/DeepLcom/deepl-php) for TYPO3, so
installations in classic mode (TER) get the same SDK as composer
installations. It has no PHP code of its own. Most changes are an update of
the SDK version.

## Issues and security

- Problems of the SDK itself belong to
  [DeepLcom/deepl-php](https://github.com/DeepLcom/deepl-php/issues).
  Problems of the packaging (autoloading in classic mode, versions,
  dependencies) are GitHub issues here.
- **Security issues are never reported publicly.** See
  [SECURITY.md](SECURITY.md).
- The maintainers track their work in an internal tracker, project `DPL`.
  That is why some commits refer to `DPL-123`.

## Branches and versions

There is one branch, `main`, serving TYPO3 12.4 to 14.3 and PHP 8.1 to 8.5.
The version of this extension is the version of the SDK it ships: 1.19.x
ships `deeplcom/deepl-php` 1.19.0, pinned exactly.

## How it works

- `composer.json` requires the SDK for composer installations.
- `contrib/composer.json` installs the same SDK into `contrib/Libraries/`
  for classic mode, with the PSR packages TYPO3 already provides replaced.
  `contrib/Libraries/` is not committed. The publish workflow builds it
  (`composer install -d contrib`) before it creates the TER artefact.
- TYPO3 14.3 autoloads `contrib/Libraries` early through
  `extra.typo3/cms.Package.providesPackages`. Before 14.3,
  `ext_localconf.php` requires its autoloader when the SDK is not loaded yet.

## Updating the SDK

The SDK version is set in `composer.json`, in `contrib/composer.json`, in
`extra.typo3/cms.version` and in `VERSION`, always together. Use the command
in the [README](README.md#set-deeplcomdeepl-php-version), it sets all of
them. A different version in `contrib/` than in `composer.json` ships a
wrong SDK to classic mode installations.

Before a pull request:

- Read the changelog of the SDK between the old and the new version.
- Check that `deepltranslate-core`, `deepltranslate-glossary` and
  `deepl-write`, which use classes of the SDK, still work with it.
  `deepltranslate-core` requires this extension with a range on its minor
  version (`~1.19.0`), so a new minor version of the SDK needs a change there
  as well. `deepl-write` requires `^1.19.0`, the glossary gets the SDK
  through core.
- Build the classic mode libraries once, `composer install -d contrib`, and
  check that `contrib/Libraries/autoload.php` exists. Do not commit
  `contrib/Libraries/`.

There is no test suite and no `Build/Scripts/runTests.sh` in this repository.

## Commit messages

The [TYPO3 Core commit message rules](https://docs.typo3.org/m/typo3/guide-contributionworkflow/main/en-us/Appendix/CommitMessage.html):

```
[TASK] Set 'deeplcom/deepl-php' to '1.19.0'

Explain why the change is needed and what it does. Wrap the body at 72
characters.
```

## Pull requests

- One pull request carries one commit, its title the subject of the commit.
  Review changes are amended and force pushed.
- Rebase onto the current `main`. The branch is merged with "rebase and
  merge", the only method allowed, after one approving review.

## Releases

Maintainers release with the commands in the [README](README.md): a commit
`[RELEASE] x.y.z`, the tag `x.y.z` on it (no `v`), and a commit
`[TASK] Set dev version x.y.(z+1)-dev`. The pushed tag publishes to the TER.
