from tkinter import *
import json
import urllib.request
import table


root = Tk()
root.title("Moje API")
root.geometry('1050x620')

def text_changed(*args):
    global tabele
    tabele.destroy()
    tworzTabele(tekst.get())

tekst = StringVar()
tekst.trace("w", text_changed)


label_szuk = Label(root, text="Szukaj").grid(row=0)
entry_szuk = Entry(root, textvariable=tekst)
entry_szuk.bind ("<Return>",text_changed)
entry_szuk.grid(row=1)

label_szuk = Label(root, text="").grid(row=2)


def tworzTabele(szukanie=None):

    global tabele
    #tworzenie frame dla tabeli

    tabele = table.Table(root, ['lp.', 'Opis', 'Data', 'Rodz', 'Cena', 'Kasjer'], column_minwidths=[None, 300, 300, None, None, 300])
    tabele.grid(columnspan=1)

    #download raw json object
    url = "http://localhost/api/index.php?szukaj="+str(szukanie)
    print(url)
    data = urllib.request.urlopen(url).read().decode()

    # parse json object
    obj = json.loads(data)

    data = []

    for i in range(len(obj)):
        data.append([obj[i]['id'], obj[i]['opis'], obj[i]['data'], obj[i]['rodz'], obj[i]['koszt'], obj[i]['kasjer']])

    tabele.set_data(data)

tworzTabele('')

cr = Label(root, text="Bartłomiej Cuper 2020").grid()
root.update()


root.mainloop()

