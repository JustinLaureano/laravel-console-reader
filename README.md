# Laravel Console Reader

## Overview

Read crap from your laravel command console

## Installation

```bash
composer require jmlaureano/laravel-console-reader
```

## Usage

To find all links for a subreddite, run this command:

```bash
php artisan read:links <subredditname>

# Example for the r/steelers subreddit
php artisan read:links steelers
```

To read the replies for a link, run this command:

```bash
php artisan read:post <link>

# Example post with replies from a subreddit
php artisan read:post https://old.reddit.com/r/steelers/comments/jux72e/current_mood.json
```
