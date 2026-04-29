# CLAUDE.md — Seth's WordPress Portfolio Theme

This file is the canonical reference for building and maintaining this project. Read it before making any changes.

---

## Project Purpose

A custom WordPress portfolio site for Seth — a senior WordPress engineer actively job hunting. The site is itself a portfolio artifact: hiring managers will read the source code, not just view the site. Every architectural decision should reflect senior-level WordPress engineering.

**No page builders. No block editor. No off-the-shelf theme. Everything custom.**

---

## Repo Structure

```
/wp-content/themes/grid-portfolio/
├── style.css
├── functions.php
├── index.php
├── front-page.php
├── page-work.php
├── single-case_study.php
├── page-about.php
├── page-contact.php
├── 404.php
├── header.php
├── footer.php
├── template-parts/
│   ├── case-study-card.php
│   └── nav.php
├── assets/
│   ├── css/
│   │   └── main.css
│   └── js/
│       ├── main.js
│       └── contact.js
└── inc/
    ├── cpt.php
    ├── acf-fields.php
    └── rest-api.php
```

---

## Design System

### Aesthetic
Dark-mode developer portfolio. Refined, editorial, technical credibility without being sterile.

### Typography
- Display/headings: `DM Serif Display` (Google Fonts)
- Body copy: `DM Sans` (weights 400, 500)
- Labels/meta/code: `JetBrains Mono` (weights 400, 500)
- Load via `wp_enqueue_style` in `functions.php` — not via `@import`

### Color Palette (CSS Custom Properties)
```css
:root {
  --bg:         #0e0e0e;
  --bg-2:       #161616;
  --border:     #2a2a2a;
  --text:       #e8e6e0;
  --text-muted: #888880;
  --accent:     #c8f04a;   /* sharp lime — the one unexpected pop */
  --accent-2:   #4a8ff0;   /* blue for links/secondary */
  --white:      #ffffff;
}
```

### Layout
- Max-width 900px for text content, centered
- Case study grid: 2-col desktop, 1-col mobile
- Full-bleed section backgrounds for visual rhythm
- Generous whitespace throughout

### Motion
- Subtle fade-in on scroll for cards (CSS only, no libraries)
- Nav link underline on hover using CSS `clip-path`
- No animation libraries

---

## Key Files & What They Do

### `functions.php`
- Theme setup: `title-tag`, `post-thumbnails`, `html5`, `register_nav_menus`
- Enqueue: Google Fonts, `main.css`, `main.js`
- Contact page only: enqueue `contact.js` + `wp_localize_script` with `restUrl` and `nonce`
- Require: `inc/cpt.php`, `inc/acf-fields.php`, `inc/rest-api.php`
- Disable bloat: `wp_generator`, `wlwmanifest_link`, `rsd_link`

### `inc/cpt.php`
Registers the `case_study` CPT:
- `public: true`, `show_in_rest: true`
- Supports: `title`, `thumbnail`, `excerpt`
- Rewrite slug: `work`
- No archive (`has_archive: false`)

### `inc/acf-fields.php`
Registers ACF fields **programmatically** via `acf_add_local_field_group()` on `acf/init` — never via database/UI export. This is intentional for version control.

Fields on `case_study`:
| Key | Label | Type |
|---|---|---|
| `field_cs_url` | Project URL | url |
| `field_cs_role` | Your Role | text |
| `field_cs_stack` | Tech Stack | textarea |
| `field_cs_problem` | The Problem | textarea |
| `field_cs_solution` | What You Built | textarea |
| `field_cs_outcome` | Outcome | textarea |
| `field_cs_year` | Year | number |

### `inc/rest-api.php`
Custom REST endpoint at `portfolio/v1/contact` (POST).
- Args: `name`, `email` (validated with `is_email`), `message`, `honey` (honeypot)
- Honeypot: if `honey` is non-empty, return 400
- Sends via `wp_mail()` to `admin_email`
- Returns `{ success: true/false, message: "..." }`

### `assets/js/contact.js`
Vanilla JS (no jQuery) `fetch` against the REST endpoint.
- Reads `portfolioData.restUrl` and `portfolioData.nonce` (localized)
- Sets `X-WP-Nonce` header
- On success: replaces form with success message
- On failure: re-enables submit, shows `.form-error` text

### `header.php`
- Fixed/sticky site header
- Logo: "Seth" (or SVG mark) linking to home
- Nav links: Work, About, Contact, GitHub ↗ (external, `noopener`)
- Mobile: hamburger toggle using vanilla JS, `data-nav-open` attribute on `<body>`
- Must call `wp_head()` — Yoast depends on it

---

## Page Templates

### `front-page.php`
1. Hero — name, descriptor ("WordPress Engineer. 8 years building things that work."), CTA to `/work`
2. Selected Work — 3 most recent `case_study` posts via `WP_Query`, uses `template-parts/case-study-card.php`
3. Skills strip — key technologies (PHP, WordPress, REST API, ACF, JavaScript, etc.)
4. CTA band — "Available for the right role" → contact page

### `page-work.php`
- Full grid of all `case_study` posts (2-col desktop, 1-col mobile)
- Cards: featured image, title, role, tech stack, excerpt

### `single-case_study.php`
- Featured image
- Title + meta (year, role, stack, live URL)
- Three ACF sections: Problem / What I Built / Outcome
- Back to Work link

### `page-about.php`
- Short bio (2–3 sentences)
- Skills grouped by category: WordPress, Languages, Tools, SEO & Performance
- Experience timeline (hardcoded HTML or ACF repeater)
- GitHub link + resume download link

### `page-contact.php`
- Intro line
- Form: name, email, message, hidden honeypot (`name="honey"`)
- Submits via `contact.js` to REST endpoint
- No plugin. No GravityForms.

---

## Performance Requirements

All four Lighthouse categories must meet these before the site is "done":

- Performance ≥ 95
- Accessibility ≥ 95
- Best Practices ≥ 95
- SEO = 100

Checklist:
- [ ] No render-blocking resources
- [ ] Images: WebP format, explicit `width` and `height` attributes
- [ ] `preconnect` hints for Google Fonts in `<head>` (before the stylesheet enqueue)
- [ ] CSS and JS minified
- [ ] Yoast SEO installed, all pages have meta description + OG image

---

## SEO

- Let Yoast handle meta — ensure `wp_head()` is called in `header.php`
- Each page needs: unique `<title>`, meta description, canonical URL
- Yoast handles Person schema on About page
- OG images set manually via Yoast per-page settings

---

## Required Plugins

Document these in README; do not commit plugin files to the repo.

| Plugin | Why |
|---|---|
| Advanced Custom Fields (free) | Case study field registration |
| Yoast SEO | Meta, schema, sitemap |
| WP Mail SMTP | Ensure `wp_mail()` delivers reliably |

No other plugins. Resist the urge to add more.

---

## What This Demonstrates to Hiring Managers

| Signal | Where |
|---|---|
| Custom theme architecture | No page builder, clean template hierarchy |
| CPT + ACF in version control | `inc/cpt.php`, `inc/acf-fields.php` |
| REST API knowledge | `inc/rest-api.php` — custom endpoint, not a plugin |
| JS without frameworks | `contact.js` — fetch API, no jQuery |
| Performance discipline | Lighthouse scores in README |
| Code quality | Public GitHub repo, readable source |
| SEO implementation | Yoast + manual meta awareness |

---

## Hosting & Local Dev

- **Production:** Flywheel hosting
- **Local dev:** Local by Flywheel
- WordPress root is at `/Users/seth/Local Sites/grid-portfolio/app/public/`
- Theme lives at `wp-content/themes/grid-portfolio/`

---

## .gitignore Targets

Exclude from the repo:
- `wp-config.php`
- `/wp-content/uploads/`
- `/wp-content/plugins/` (document required plugins in README instead)
- `node_modules/`

---

## Code Conventions

- PHP: WordPress coding standards. Use `esc_*` functions on all output. Prefix all functions/hooks with `portfolio_`.
- CSS: Custom properties for all design tokens. Mobile-first. No utility frameworks.
- JS: Vanilla ES6+. No jQuery. No build tools required.
- All ACF fields registered in PHP, never via database export.
- Never use `the_content()` for case studies — content lives in ACF fields.
