# FeedPro Project
Feedpro Admin Panel

<h3>Installation Requirements</h3>
<p>
	Git<br>
	XAMPP/WAMP or any Local server you want to use.
</p>

<h3>Server Req.</h3>
<p>PHP >=5.6</p>

<h3>Installing FeedPro Admin Panel</h3>
<p>
	1) Go to your Local server web directory and open Git Bash and then run this following command.<br>
	<b>git clone https://github.com/lazycrazymaybe/feedpro.git</b> to clone the repository.

	git clone https://github.com/lazycrazymaybe/feedpro.git	
</p>
<p>
	2) Then run <b>git clone staging</b> to change to staging branch.<br>
	3) Add .htaccess file inside <b>feedpro/application</b> folder.<br>
	   Put this inside the .thaccess file.
</p>	
<pre class="code highlight js-syntax-highlight plaintext white" lang="plaintext" v-pre="true"><code>
<span id="LC1" class="line" lang="plaintext">RewriteEngine On</span>
<span id="LC2" class="line" lang="plaintext">RewriteCond %{REQUEST_FILENAME} !-f</span>
<span id="LC3" class="line" lang="plaintext">RewriteCond %{REQUEST_FILENAME} !-d</span>
<span id="LC4" class="line" lang="plaintext">RewriteRule ^(.*)$ index.php/$1 [L]</span></code>
</pre>
<p>
	Test the application by running the folling link into the browser.<br>
	<code>
		localhost/feedpro/admins
	</code>
</p>
