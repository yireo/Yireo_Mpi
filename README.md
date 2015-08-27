# Yireo MPI (Magento Performance Insights)

This repository contains the sources for a Magento 1 extension, that
adds an API to Magento - currently used for the Magento Performance
Insights (MPI) service developed by Yireo. 

The Yireo MPI service allows you to quickly gather numerous metrics 
from your Magento shop and its hosting environment. 
With an active MPI subscription, these data are then collected and
stored in the Yireo cloud. Next, the data are interpreted and presented
to you visually on the Yireo site. In the end, you get an overview of
performance settings, specific to your environment, and custom advice on
how to optimize things to the max.

## Authentication
Access to the API is only allowed when a specific secret is added to the
URL calls. The secret must be of a length of 10 characters or more, and
can be configured in the Magento **System Configuration** in the section
**Yireo MPI**. After the secret is set, the URLs need to get the
additional secret as follows:

    http://MAGENTO/mpi/index/index/secret/SECRET

## Access to the API
There are 2 ways to access the API of this MPI extension. The first
method is to call upon the modules URL starting with `mpi` - this is the MVC method.
The second method is to call upon the file `yireo_mpi.php` - this is the entry-file method.

### MVC method
The `index` action of the `IndexController` can be accessed as such:

    http://MAGENTO/mpi/index/index/secret/SECRET

This gives a listing of all the available metric-groups and their
metrics.

To get all data from the metric-group "basic", use the following:

    http://MAGENTO/mpi/index/collect/group/basic/secret/SECRET

To get all data from the metric "test", use the following:

    http://MAGENTO/mpi/index/collect/metric/test/secret/SECRET

Note that one metric might still contain multiple results.

The API only handles basic GET and POST requests, no fancy REST or JSON-RPC.

### Entry-file method
The entry-file can be accessed as such:

    http://MAGENTO/yireo_mpi.php

To get all data from the metric-group "basic", use the following:

    http://MAGENTO/yireo_mpi.php?action=collect&group=basic&secret=SECRET


## Format
By default, the output is JSON format. You can switch to a simple PHP
dump by changing the `format` parameter in the URL:

    http://MAGENTO/mpi/index/index/format/json
    http://MAGENTO/mpi/index/index/format/dump

