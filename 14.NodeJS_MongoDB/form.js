var http = require('http');
var fs = require('fs');
var qs = require('querystring');
var mongo = require('mongodb');
var client = mongo.MongoClient;
var url = "mongodb+srv://person:Alc0n0xDetergent@cluster0.40x5c.mongodb.net/stock_symbol?retryWrites=true&w=majority";

http.createServer(function (req, res) 
{
  
  if (req.url == "/")
  {
      file = 'search.html';
      fs.readFile(file, function(err, txt) {
      res.writeHead(200, {'Content-Type': 'text/html'});
      res.write("This is the home page<br>");
      res.write(txt);
      res.end();
      });
  }
  else if (req.url == "/process")
  {
     res.writeHead(200, {'Content-Type':'text/html'});
     res.write ("Process the form<br>");
     pdata = "";
     req.on('data', data => {
       pdata += data.toString();
     });

    // when complete POST data is received
    req.on('end', () => {
        var data = qs.parse(pdata);
        var query = data["search_query"];
        var method = data["query"];
        if (method == "company_name" || method == "stock_symbol" )
        {
            let list = connect(method, query); 
            stuff(list); 
            // console.log(list);
            // if (list.length == 0)
            //     console.log("no item");
        }// end if statement
        
        res.end(); 
    });
    
  }
  else 
  {
      res.writeHead(200, {'Content-Type':'text/html'});
      res.write ("Unknown page request");
      res.end();
  }


}).listen(8080);
function stuff(list)
{
    console.log(list);
    if (list.length == 0)
        console.log("no item");
}

async function connect(method, query)
{
    await client.connect(url, function(err, db)
    {
        console.log("connected");
        var dbObj = db.db("stock_symbols");
        var collection = dbObj.collection("companies");
                    
        if (method == "company_name")
        {
            collection.find({Company: query}).toArray(function(err, results) 
            {
                if (err) throw err;
                res.write(results);
                // console.log(results);
                db.close();
                return results; 
            }); //end company to array 
        } //end if checking method name 
        else 
        {
            collection.find({Ticker: query}).toArray(function(err, results) 
            {
                
                if (err) throw err;
                // console.log(results);
                db.close();
                return results; 
            }); //end ticker to array 
        } //end else checking method name        
        
    }); //end connect
}