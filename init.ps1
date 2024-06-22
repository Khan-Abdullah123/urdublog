# Set the repository URL
$repoUrl = "https://github.com/QuaziTalha/adminLumen.git"

# Clone the repository
git init
git remote add origin $repoUrl
git fetch
git checkout --force origin/main

# Remove the Git-related files
Remove-Item -Path ".\.git" -Force -Recurse

# Run composer install
composer install
