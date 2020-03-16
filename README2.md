Question 2
You are assigned to a major project that will attempt to abstract and consolidate similar business logic from 2
different applications. While each application serves a different market and user, each application has some
shared functionality. Currently the implementation is written separately, but some functions could be abstracted
to a single implementation. How would you determine which functionality should be abstracted and used by both
applications. Which tools (languages, cloud services, etc.) would you choose to accomplish your
implementation?

For this, I would move as many of the shared backend services to an API that can then be called and used across multiple applications.
This would keep code changes related to business logic in a single area. When changes are made, only one area will need updated rather than multiple.
The functionality that should be abstracted is the functionality that is shared between applications. I would recommend using tools that will allow the 
business to continue to scale and grow. 
