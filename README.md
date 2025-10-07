# Dicer MVC

This repository implements a lightweight MVC application using PHP, Composer autoloading, and the izniburak router. The project has been reorganized to mirror familiar Laravel/Lumen style conventions so that the moving pieces are easier to find.

## Directory layout

```
app/
  Http/
    Controllers/      # Route controllers
    Middleware/       # HTTP middleware
  Models/             # Eloquent models and database helpers
  Support/            # Shared helpers (Template, Session, Req, etc.)
bootstrap/
  app.php             # Boots configuration, autoloading, and Eloquent
config/
  constants.php       # Application and database configuration constants
public/
  index.php           # Web entry point
  assets/             # CSS, JS, images, and third-party libraries
resources/
  views/              # Blade-like PHP templates rendered by Template/Renderer
routes/
  web.php             # HTTP route definitions
scripts/
  *.php               # One-off maintenance/integration scripts
vendor/
  ...                 # Composer dependencies
```

### Updating autoloading

After adding new classes under `app/`, run:

```bash
composer dump-autoload
```

### Running database scripts

The files inside `database/` now bootstrap through `bootstrap/app.php`, so you can execute them directly with PHP:

```bash
php database/User.php
```

This will ensure Eloquent is initialised with the same configuration as the main application.
