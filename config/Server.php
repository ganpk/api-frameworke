<?php
namespace Config;

/**
 * 服务端口层配置文件
 *
 */
class Server
{
    /**
     * tcp 监听端口号
     * @var integer
     */
    public static $listen = array(
        'ip'=>'0.0.0.0',
        'port' => '80'
    );
    
    /**
     * server配置选项
     * @var array
     */
    public static $settings = array(
        
        /*
         | 守护进程化。设置daemonize => 1时，程序将转入后台作为守护进程运行。长时间运行的服务器端程序必须启用此项。
         */
        'daemonize' => 0,
        
        /*
         | 设置worker/task子进程的所属用户。
         | 服务器如果需要监听1024以下的端口，必须有root权限。但程序运行在root用户下，代码中一旦有漏洞，攻击者就可以以root的方式执行远程指令，风险很大。
         | 配置了user项之后，可以让主进程运行在root权限下，子进程运行在普通用户权限下。
         */
        'user' => 'root',
        
        /*
         | 重定向Worker进程的文件系统根目录。此设置可以使进程对文件系统的读写与实际的操作系统文件系统隔离。提升安全性。
         */
        //'chroot' => '/www/api-frameworke',
        
        /*
         | 指定swoole错误日志文件。在swoole运行期发生的异常信息会记录到这个文件中。默认会打印到屏幕。
         | 注意log_file不会自动切分文件，所以需要定期清理此文件。观察log_file的输出，可以得到服务器的各类异常信息和警告。
         | log_file中的日志仅仅是做运行时错误记录，没有长久存储的必要。
         | 开启守护进程模式后(daemonize => true)，标准输出将会被重定向到log_file。在PHP代码中echo/var_dump/print等打印到屏幕的内容会写入到log_file文件
         */
        //'log_file' => '/data/logos/server.log',
        
        /*
         | 设置启动的worker进程数。
         | 业务代码是全异步非阻塞的，这里设置为CPU的1-4倍最合理
         | 业务代码为同步阻塞，需要根据请求响应时间和系统负载来调整
         | 比如1个请求耗时100ms，要提供1000QPS的处理能力，那必须配置100个进程或更多。
         | 但开的进程越多，占用的内存就会大大增加，而且进程间切换的开销就会越来越大。所以这里适当即可。不要配置过大。
         | 每个进程占用40M内存，那100个进程就需要占用4G内存
         */
        'worker_num' => 4,
        
        /*
         | reactor线程数，reactor_num => 2，通过此参数来调节主进程内事件处理线程的数量，以充分利用多核。默认会启用CPU核数相同的数量。
         | reactor_num一般设置为CPU核数的1-4倍，在swoole中reactor_num最大不得超过CPU核数*4。
         | swoole的reactor线程是可以利用多核，如：机器有128核，那么swoole会启动128线程。
         | 每个线程能都会维持一个EventLoop。线程之间是无锁的，指令可以被128核CPU并行执行。
         | 考虑到操作系统调度存在一定程度的偏差，可以设置为CPU核数*2，以便最大化利用CPU的每一个核。
         | reactor_num必须小于或等于worker_num。如果设置的reactor_num大于worker_num，那么swoole会自动调整使reactor_num等于worker_num
         | 1.7.14以上版本在超过8核的机器上reactor_num默认设置为8
         */
        'reactor_num' => '4',
        
        /*
         | 设置worker进程的最大任务数。一个worker进程在处理完超过此数值的任务后将自动退出。这个参数是为了防止PHP进程内存溢出。
         | 如果不希望进程自动退出可以设置为0
         | 当worker进程内发生致命错误或者人工执行exit时，进程会自动退出。主进程会重新启动一个新的worker进程来处理任务
         */
        'max_request' => 1500,
        
        /*
         | 服务器程序，最大允许的连接数，如max_conn => 10000, 此参数用来设置Server最大允许维持多少个tcp连接。超过此数量后，新进入的连接将被拒绝。
         | max_connection最大不得超过操作系统ulimit -n的值，否则会报一条警告信息，并重置为ulimit -n的值
         | max_connection默认值为ulimit -n的值
         | 此参数不要调整的过大，根据机器内存的实际情况来设置。Swoole会根据此数值一次性分配一块大内存来保存Connection信息
         */
         #'max_conn' => 10000,
    
        
        /*
         | swoole在配置dispatch_mode=1或3后，系统无法保证onConnect/onReceive/onClose的顺序，因此可能会有一些请求数据在连接关闭后，才能到达Worker进程。
         | discard_timeout_request配置默认为true，表示如果worker进程收到了已关闭连接的数据请求，将自动丢弃。
         | discard_timeout_request如果设置为false，表示无论连接是否关闭Worker进程都会处理数据请求。
         */
        'discard_timeout_request' => true
    );    
}