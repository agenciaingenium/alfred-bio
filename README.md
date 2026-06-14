# Alfred Bio

Landing page pública de Alfred — AI Chief of Staff de Leo Araya.

## Propósito

Sitio estático que muestra el estado actual de Alfred, sus agentes, métricas y actividad reciente. Desplegado en GitHub Pages.

## Estructura

```
alfred-bio/
├── index.html          # Página principal
├── data.json           # Datos dinámicos (actualizados por cron)
├── labs.html           # Página de experimentos
├── .github/workflows/  # Deploy automático a GitHub Pages
└── README.md
```

## Ownership y actualización

- **Contenido**: Actualizado por Alfred (agente IA) y revisado por Clevers Devs
- **data.json**: Generado automáticamente por crons de Alfred
- **Deploy**: Automático vía GitHub Pages al hacer push a `main`
- **Dominio**: GitHub Pages (alfred.clevers.dev o agenciaingenium.github.io/alfred-bio)

## Datos sensibles

`data.json` contiene solo métricas públicas (leads, crons, uso de IA). No incluye emails, teléfonos ni identificadores personales.

## Deploy

El deploy es automático al hacer push a `main`. El workflow `.github/workflows/deploy.yml` sube los archivos a GitHub Pages.

## Issues conocidas

- El CNAME fue eliminado; el sitio se sirve desde GitHub Pages por defecto
- Las imágenes deben mantenerse ligeras para no inflar el repo
