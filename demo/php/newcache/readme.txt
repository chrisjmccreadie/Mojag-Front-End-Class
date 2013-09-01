Hello World Applicaiton being cached
Coded by Chris McCreadie
05/10/2012

This example connects to Mojag and pull down one page of data which has one element called title.

It first checks to see if the object has been cached if it has then serves this cache.  It is memcache like and it allows to maintain the same
level of abstraction on our objects as we do with everything else.

Then it opens the mojag class and then fetcches a pages based on the output name.  

If then uses searchContent function to get the element data out of the object.

