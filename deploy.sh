rm -rf ./app/cache/*
rsync --delete --exclude 'app/cache/' --exclude 'app/logs/' -Paz /home/projects/bangnation.net tdsheppard77@bangnation.net:/home/tdsheppard77/
