#### Notice

When updating Filament - even a minor bump - 
we need to rebuild a customised file.

We need to update

    morplees/resources/views/vendor/filament/components/layouts/app.blade.php

based on the new version of the file in the vendor folder

    morplees/vendor/filament/filament/resources/views/components/layouts/app.blade.php

If this is not done, the entire app can break.
