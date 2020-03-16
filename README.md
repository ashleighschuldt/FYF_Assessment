Question 1
A SQL database table has grown very large. It has over 100,000,000 entries. The table is written to and read
from with some frequency. The table may need to be “sharded” without impacting the use of the software. How
would you solve this problem? If there is a better solution, what would that be?

An alternate solution would  be to implement database caching rather than actually sharding the database. This would impact the user experience very minimally and could potentially also increase load times and page performance. However, sharding may still be the best bet to increase page performance depending on if the issue is how long it takes to query the database.  
