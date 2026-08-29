# Contributing to Alfred Bio

## Development Guidelines

### Pre-commit Hook

Install the pre-commit hook to catch issues before committing:

```bash
cp hooks/pre-commit .git/hooks/pre-commit
chmod +x .git/hooks/pre-commit
```

The hook will:
- Run HTML linting with htmlhint
- Check for sensitive data in staged files
- Warn about large files (>1MB)

### Testing Changes

**NEVER test workflow changes directly on `main`.**

1. Create a feature branch: `git checkout -b feat/your-change`
2. Make your changes
3. Push the branch: `git push origin feat/your-change`
4. Create a PR to `main`
5. Verify the deploy preview works
6. Merge after approval

### Branch Strategy

- `main` — Production branch, protected
- `feat/*` — Feature branches for new capabilities
- `fix/*` — Bug fix branches
- `docs/*` — Documentation updates

### Commit Conventions

Use [Conventional Commits](https://www.conventionalcommits.org/en/v1.0.0/) format:

```
<type>(<scope>): <description>
```

Types:
- `feat`: New feature
- `fix`: Bug fix
- `docs`: Documentation changes
- `chore`: Maintenance tasks
- `ci`: CI/CD changes

### Content Updates

- **data.json**: Updated automatically by Alfred's cron jobs
- **index.html**: Manual edits for layout/structure changes
- **labs.html**: Manual edits for new experiments

### Backup Policy

Before making significant changes:

1. Create a tag: `git tag backup-YYYY-MM-DD`
2. Push the tag: `git push origin backup-YYYY-MM-DD`
3. This creates a restore point

### Security

- **Never commit sensitive data** — API keys, passwords, tokens
- **data.json** should only contain public metrics
- **Review before pushing** — check `git diff` for sensitive data

### Domain Configuration

The site is served from GitHub Pages. The CNAME file contains `alfred.clevers.dev`.

If the domain changes:
1. Update the CNAME file
2. Update DNS records
3. Verify GitHub Pages settings

### Analytics

To add analytics:

1. Create a `status.json` file with metrics
2. Update the cron job to generate this file
3. The site will display the metrics dynamically

### Known Issues

- CNAME was deleted and recreated; verify DNS is correct
- Images should be kept lightweight to avoid repo bloat
- Deploy is automatic on push to `main` — use feature branches!
