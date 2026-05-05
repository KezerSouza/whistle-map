# Whistle Map

A website platform to record and hear whistles, with an interactive map where anyone can record their whistles, and they are pinned to the exact location where they were whistled.

## About

Whistle Map lets you explore the world through sound. Open the map, find a whistle near you, and listen. Or record your own and pin it to where you are right now. No account needed to contribute.

## Features

- Record whistles directly in the browser
- Explore whistles from around the world
- Geospatial search powered by PostGIS
- Rate whistles from other users
- Guest submissions — no account required to submit a whistle, the recording will be saved as anonymous

## Tech Stack

- **Backend:** Laravel, PostgreSQL + PostGIS
- **Frontend:** Blade, Livewire, Leaflet.js

## Requirements

- PHP 8.4+
- PostgreSQL 15+ with PostGIS extension installed and enabled
- FFmpeg

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install && npm run build
```

## Database Model

The database schema is defined in [`docs/db-model.dbml`](docs/db-model.dbml).  
You can visualize it by pasting the file contents into [dbdiagram.io](https://dbdiagram.io).

## License
MIT
