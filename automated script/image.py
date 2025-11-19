import pandas as pd
import requests
import os

# --- SETTINGS ---
CSV_FILE = "Product-image-data.csv"       # your CSV file
URL_COLUMN = "LocationKey"                # column containing URLs
OUTPUT_FOLDER = r"D:\images"           # save location on D drive
# ----------------

# Create folder if not exists
os.makedirs(OUTPUT_FOLDER, exist_ok=True)

# Load CSV
df = pd.read_csv(CSV_FILE)

# Loop through each URL
for idx, url in enumerate(df[URL_COLUMN]):
    try:
        if pd.isna(url):
            print(f"[{idx}] Skipped (empty URL)")
            continue

        # Build filename
        filename = os.path.join(OUTPUT_FOLDER, f"image_{idx}.jpg")

        # Download image
        response = requests.get(url, timeout=10)
        response.raise_for_status()

        # Save image
        with open(filename, "wb") as f:
            f.write(response.content)

        print(f"[{idx}] Downloaded → {filename}")

    except Exception as e:
        print(f"[{idx}] Failed → {e}")

print("✔ All downloads completed!")
