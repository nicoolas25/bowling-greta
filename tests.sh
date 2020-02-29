files=$(ls src/*.php tests/*.php)

echo "Monitoring..."
echo "$files"

while true; do
  inotifywait -qq -e close_write $files
  phpunit --bootstrap src/autoload.php tests
done
