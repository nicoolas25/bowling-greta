files=$(ls src/*.php tests/*.php)

echo "Monitoring..."
echo "$files"

while true; do
  inotifywait -qq -e close_write $files
  clear
  phpunit --colors tests
done
