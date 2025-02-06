# Instructions 
When you clone the project, go in the folder and type composer install --ignore-platform-reqs

You will need only docker to run the project 

Add an alias for sail on ./vendor/bin/sail

When composer installed all the dependencies : 

- cp .env.example .env
- sail up 
- sail npm i 
- sail npm run dev

Add this to the file .git/hooks/pre-commit

```
#!/bin/sh

# Get the list of changed PHP files (Added, Copied, Modified)
IFS=$'\n' read -d '' -r -a CHANGED_FILES <<< "$(git diff --cached --name-only --diff-filter=ACM -- '*.php')"

echo "Running phpstan..."
vendor/bin/phpstan analyse -c phpstan.neon
phpstan_exit_code=$?

# If phpstan failed (exit code not 0), exit the hook to prevent commit
if [ $phpstan_exit_code -ne 0 ]; then
    echo "Phpstan found issues. Commit aborted."
    exit 1
fi


# If there are changed PHP files
if [[ ${#CHANGED_FILES[@]} -gt 0 ]]; then
  echo "Running duster fix on changed PHP files..."
  
  # Run duster on each of the changed files
  ./vendor/bin/duster fix "${CHANGED_FILES[@]}"
  duster_exit_code=$?

  # If duster failed (exit code not 0), exit the hook to prevent commit
  if [ $duster_exit_code -ne 0 ]; then
      echo "Duster found issues. Commit aborted."
      exit 1
  fi

  # Re-add the fixed files
  git add "${CHANGED_FILES[@]}"
fi
```

```
chmod +x .git/hooks/pre-commit
```

# List of code quality implementations 
- duster (linter)
- phpstan
- post commit hook 


