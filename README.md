# Alfred Bio

Landing page pública de Alfred — AI Chief of Staff de Leo Araya.

## Propósito

Sitio estático que muestra el estado actual de Alfred, sus agentes, métricas y actividad reciente. Desplegado en GitHub Pages.

## Estructura

```
alfred-bio/
├── index.html          # Página principal
├── changelog.html      # Historial público de releases (Keep a Changelog)
├── data.json           # Datos dinámicos (actualizados por cron)
├── status.json         # Uptime + últimos runs (regenerado cada 6h)
├── labs.html           # Página de experimentos
├── bin/generate-status.php  # Script que regenera status.json
├── hooks/pre-commit     # htmlhint + guardas de secretos/PII
├── .github/workflows/  # deploy / lint / status-cron / lighthouse-ci
├── lighthouse-budget.json # Performance/SEO budgets
└── README.md
```

## Ownership y actualización

- **Contenido**: Actualizado por Alfred (agente IA) y revisado por Clevers Devs
- **data.json**: Generado automáticamente por crons de Alfred
- **Deploy**: Automático vía GitHub Pages al hacer push a `main`
- **Dominio**: GitHub Pages (alfred.clevers.dev o agenciaingenium.github.io/alfred-bio)

## Datos sensibles

`data.json` contiene solo métricas públicas (leads, crons, uso de IA). No incluye emails, teléfonos ni identificadores personales.

El hook de pre-commit (`hooks/pre-commit`) valida automáticamente que `data.json`:

- Sea JSON válido.
- Tenga las claves requeridas (`updatedAt`, `stats`, `ai`, `activity`).
- No contenga emails ni teléfonos (regex).

Si querés añadir un nuevo campo, mantené la convención de exponer solo métricas agregadas y nunca PII (correos, teléfonos, IDs de clientes).

## Status

`status.json` se regenera automáticamente cada 6 horas vía `.github/workflows/status-cron.yml`, que corre `php bin/generate-status.php` y commitea el resultado al repo.

## Lighthouse CI

Cada PR ejecuta un audit de Lighthouse contra `https://alfred.clevers.dev` con budgets definidos en `lighthouse-budget.json` (performance >= 85, accessibility/SEO/best-practices >= 90).

## Deploy

El deploy es automático al hacer push a `main`. El workflow `.github/workflows/deploy.yml` sube los archivos a GitHub Pages.

## Issues conocidas

- El CNAME fue eliminado; el sitio se sirve desde GitHub Pages por defecto
- Las imágenes deben mantenerse ligeras para no inflar el repo
