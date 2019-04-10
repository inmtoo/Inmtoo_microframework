# inmtooframework-beta-v0
Light PHP framework. Just copy to the hosting and get started. It`s very easy framework. Current libraries: Database; Authorization. 
We prepare new version of this product and next functional and libraries in work: Files; Images; Email; Upload CSV / Excel; Content; Catalog; Admin Panel.
We invite developers to help to the project.

SMALL DOCUMENTATION

Inmtoo PHP Framework - MVC Framework. SYSTEM Functions. "/system/" - system functions. "/system/core/" - DB connections; Router; View - function. "/system/libraries/" - Database; Authorization. "/system/core/helpers/" - Form; Redirect.

------------------------------------------------

APPLICATION. 
Controllers - "/application/controllers/". Models - "/application/models/". Views - "/application/views/".

http://site.com/controllers/function/arg1/arg2/arg3/. Arguments are passed to the function as an array:

function YourFunctions($args) { .... }

arg1, arg2, arg3 - array element values. $args[0] is "arg1".

We use autoload of classes. So to call method of Database (for example), use Database::insert($table, $add)

----------------------------------------------
FORM

Form::request('var') instead $_REQUEST['var']

Form::get('var') instead $_GET['var']

Form::post('var') instead $_POST['var']

---------------------------------------------


Thank you so much

Max Sharun
