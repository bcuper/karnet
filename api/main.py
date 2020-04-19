from tkinter import *
import json
import urllib.request
import table


root = Tk()
root.title("Moje API")
root.geometry('1050x600')

#Nagłowki tabeli
label_lp = Label(root, text="lp.").grid(row=0,column=0)
label_opis = Label(root, text="Opis").grid(row=0, column=1)
label_data = Label(root, text="Data wejścia").grid(row=0, column=2)
label_rodz = Label(root, text="Rodzaj").grid(row=0, column=3)
label_cena = Label(root, text="Cena").grid(row=0, column=4)
label_kasjer = Label(root, text="Kasjer").grid(row=0, column=5)

#pola do szukania
entry_lp = Entry(root).grid(row=1,column=0)
entry_opis = Entry(root).grid(row=1,column=1)
entry_data = Entry(root).grid(row=1,column=2)
entry_rodz = Entry(root).grid(row=1,column=3)
entry_cena = Entry(root).grid(row=1,column=4)
entry_kasjer = Entry(root).grid(row=1,column=5)

#przycisk szukaj

button_szukaj = Button(root, text="Szukaj").grid(row=1,column=6)

#tworzenie frame dla tabeli

tabele = table.Table(root, ['lp.', 'Opis', 'Data', 'Rodz', 'Cena', 'Kasjer'], column_minwidths=[None, 300, 300, None, None, 300])
tabele.grid(columnspan=7)

#download raw json object
url = "http://localhost/api/index.php"
data = urllib.request.urlopen(url).read().decode()

# parse json object
obj = json.loads(data)

data = []

for i in range(len(obj)):
    data.append([obj[i]['id'], obj[i]['opis'], obj[i]['data'], obj[i]['rodz'], obj[i]['koszt'], obj[i]['kasjer']])




tabele.set_data(data)

cr = Label(root, text="Bartłomiej Cuper 2020").grid()
root.update()


root.mainloop()

