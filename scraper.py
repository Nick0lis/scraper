import requests
from bs4 import BeautifulSoup
from pymongo import MongoClient

#url = requests.get('https://finance.yahoo.com/most-active')

#f = open('./webpage.html', 'wb')
#f.write(url.content)
#f.close()

#soup = BeautifulSoup(url.text, "html.parser")

f = open("./most_active_stocks.html")
soup = BeautifulSoup(f, "html.parser")
f.close()

# Store data in MongoDB
client = MongoClient()
db = client['stock_db']
collection = db['most_active_stocks']

# Clear previous data
collection.delete_many({})

rows = soup.find_all("tr", {"class": "row yf-1570k0a"})
doc = []

index = 1;

for i in rows:
    symbol = i.find('span', {"class":"symbol yf-5ogvqh"}).string
    name = i.find("div", {"class":"leftAlignHeader yf-362rys enableMaxWidth"}).string
    price_tag = i.find("fin-streamer", {"data-field":"regularMarketPrice"})
    price = float(price_tag["data-value"])
    change_tag = i.find("fin-streamer", {"data-field":"regularMarketChange"})
    change = change_tag.string
    volume = i.find("fin-streamer", {"data-field":"regularMarketVolume"}).string

    doc.append({
        "Index": index,
        "Symbol": symbol,
        "Name": name,
        "Price": price,
        "Change": change,
        "Volume": volume
    })

    index += 1

collection.insert_many(doc)

print(doc[0])
