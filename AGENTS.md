# Agent instructions

Instructions for coding agents working in this repository. `CLAUDE.md`
imports this file. Read [CONTRIBUTING.md](CONTRIBUTING.md) first: its rules
apply to you in full. This file adds what an agent needs on top of it.

This repository has one branch, `main`, and no PHP code of its own. It
packages the DeepL PHP SDK for TYPO3 12.4 to 14.3.

## Rules

- **Never write to a remote** (push, tag, pull request, issue, comment,
  review, merge) unless the maintainer asks for exactly that. A pushed tag
  publishes a release to the TER.
- **Never credit a tool or a model** in commits, pull requests, issues, code
  comments or documentation. The human who submits the change is its author.
- Scratch files, plans, reports and downloads go into `.agent/` (git
  ignored), never into the tracked tree and never into `/tmp`.
- Verify by running, not by recalling. Say what you ran and what you did not
  run.

## Working here

- The SDK version lives in four places (`composer.json`,
  `contrib/composer.json`, `extra.typo3/cms.version`, `VERSION`). Change them
  together, with the README command, never one alone.
- Never commit `contrib/Libraries/`, `vendor/` or a `composer.lock`. They are
  build output.
- There are no tests here. Verify a new SDK version where it is used: the
  test suites of `deepltranslate-core`, `deepltranslate-glossary` and
  `deepl-write` against it, and say which ones you ran.
- Do not change the `replace` and `provide` sections of
  `contrib/composer.json` without a reason you can name: they keep classic
  mode from loading a second copy of the PSR packages TYPO3 ships.
