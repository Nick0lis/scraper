# Web Scraper and Sortable Data Viewer

## Overview
This project consists of a Python web scraper that extracts and sorts data from websites, stores the scraped data in MongoDB, and a PHP frontend that displays the data in a sortable table. 
The table allows users to click on column headers to sort the data dynamically.

This setup demonstrates a complete data pipeline:  
- Data extraction with Python  
- Data storage using MongoDB  
- Interactive data presentation with PHP

## Files

- `scraper.py` — Python script to scrape, sort, and upload data to MongoDB.  
- `index.php` — PHP file that fetches data from MongoDB and displays it in a sortable HTML table.

## Prerequisites

- Python 3.x  
- MongoDB installed and running  
- PHP server (e.g., Apache or built-in PHP server)  
- Required Python packages (see below)

## Installation & Usage

1. **Set up MongoDB**  
   Make sure MongoDB is installed and running locally or remotely. Create a database and collection if necessary.

2. **Run the Python scraper**  
   Install required Python packages:  
   ```bash
   pip install pymongo requests beautifulsoup4
