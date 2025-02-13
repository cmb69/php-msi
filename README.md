# PHP-MSI

Create MSI installers for PHP.

> [!CAUTION]
> These installers are highly experimental, and not supposed to  be used for
> any production purposes.

> [!CAUTION]
> For now, the installers are built with the obsolete Wix Toolset v3.

## Notes regarding the current state

* Only a single PHP installation is supported.
* Downgrading to an older PHP version is not allowed.
* Installing the same or a newer PHP version does not verify the installed
  variant (NTS/ZTS, x64/x86), so it is possible to replace, say, an NTS x64
  installation with a ZTS x86 version. That doesn't work for manually installed
  PECL extensions which would need to be replaced manually with the respective
  variants.
* Installing a newer PHP major or minor version, e.g. upgrading PHP 8.3.17 to
  PHP 8.4.4 does not cater to manually installed PECL extensions which would
  need to be manually upgraded.
* Besides installing the same files which are contained in the official
  PHP downloads from <https://windows.php.net/>, only two shortcuts are
  installed (Interactive Shell and Online Documentation).
* The only supported installation customization is selecting the installation
  path.

## Building yourself

See <https://github.com/cmb69/php-msi/blob/main/.github/workflows/build.yml>.
