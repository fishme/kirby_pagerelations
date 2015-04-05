# Kirby2 Pagerelations

##Description
With this Kirby2 plugin you can set 1:N page relations. (drag/drop)
You don't know what is Kirby? <http://getkirby.com>

##How to use?

clone inside your project /site/fields/ (maybe rename directory to "pagerelations")

```bash
git clone https://github.com/fishme/kirby_ckeditor.git
```

or download/paste 

That was it. :)

Demo:
short movie: <http://www.fishme.de/github/kirby2_pagerelation_movie.mov>

![Pagerelation](http://www.fishme.de/github/kirby2_pagerelation.png)


###Blueprint

First some short words. This was my first Kirby2 plugin, so it is not perfect. (special the query)

For my usecase I don't needed to have all pages on the left side (Available). My idea was it to see pages based on field and content.

So I added hidden fields in the other blueprints called in this case "ARIB" and added a default content "arib_content" - This plugin looks for that.


```yaml
  contents:
    label: add content to your hotspot
    searchfield: ARIB
    searchcontent: arib_content
    type: pagerelations
```

##Todos
there are some todos :)

* refactor search query
* finish query based on the template
* remove some crazy code fragments
* add code documentation

##Feedback
go to my page <http://www.fishme.de>
