#!/bin/bash

# Output file where the combined content will be written
output_file="combined_output.txt"

# Clear the output file if it exists, or create a new one
> "$output_file"

# Loop through all files recursively from the current directory
find . -type f | while read -r file; do
    # Skip Zone.Identifier files and image files (jpg, jpeg, png, gif)
    if [[ "$file" =~ :Zone.Identifier$ ]] || [[ "$file" =~ \.(jpg|jpeg|png|gif|bmp|tiff|svg|webp)$ ]]; then
        continue
    fi

    # Get the relative path of the file
    relative_path="${file#./}"
    echo "$relative_path"

    # Write the formatted header and file contents into the output file
    echo "==> $relative_path <===" >> "$output_file"
    cat "$file" >> "$output_file"
    echo -e "\n===== END OF FILE =====\n" >> "$output_file"
done

