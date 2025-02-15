USE [master]
GO
/****** Object:  Database [MISGlobal]    Script Date: 10-02-2025 11:27:50 ******/
CREATE DATABASE [MISGlobal]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'MISGlobal', FILENAME = N'D:\Program Files\Microsoft SQL Server\MSSQL12.SQLEXPRESS\MSSQL\DATA\MISGlobal.mdf' , SIZE = 1361920KB , MAXSIZE = UNLIMITED, FILEGROWTH = 1024KB )
 LOG ON 
( NAME = N'MISGlobal_log', FILENAME = N'D:\Program Files\Microsoft SQL Server\MSSQL12.SQLEXPRESS\MSSQL\DATA\MISGlobal_log.ldf' , SIZE = 45631808KB , MAXSIZE = 2048GB , FILEGROWTH = 10%)
GO
ALTER DATABASE [MISGlobal] SET COMPATIBILITY_LEVEL = 100
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [MISGlobal].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [MISGlobal] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [MISGlobal] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [MISGlobal] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [MISGlobal] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [MISGlobal] SET ARITHABORT OFF 
GO
ALTER DATABASE [MISGlobal] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [MISGlobal] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [MISGlobal] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [MISGlobal] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [MISGlobal] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [MISGlobal] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [MISGlobal] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [MISGlobal] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [MISGlobal] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [MISGlobal] SET  DISABLE_BROKER 
GO
ALTER DATABASE [MISGlobal] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [MISGlobal] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [MISGlobal] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [MISGlobal] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [MISGlobal] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [MISGlobal] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [MISGlobal] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [MISGlobal] SET RECOVERY FULL 
GO
ALTER DATABASE [MISGlobal] SET  MULTI_USER 
GO
ALTER DATABASE [MISGlobal] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [MISGlobal] SET DB_CHAINING OFF 
GO
ALTER DATABASE [MISGlobal] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [MISGlobal] SET TARGET_RECOVERY_TIME = 0 SECONDS 
GO
ALTER DATABASE [MISGlobal] SET DELAYED_DURABILITY = DISABLED 
GO
USE [MISGlobal]
GO
/****** Object:  User [reconuser]    Script Date: 10-02-2025 11:27:50 ******/
CREATE USER [reconuser] WITHOUT LOGIN WITH DEFAULT_SCHEMA=[dbo]
GO
/****** Object:  Table [dbo].[amlqueue]    Script Date: 10-02-2025 11:27:50 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[amlqueue](
	[txndate] [date] NULL,
	[txno] [varchar](20) NULL,
	[senddate] [date] NULL,
	[fcamt] [decimal](18, 3) NULL,
	[purpose] [varchar](255) NULL,
	[source] [varchar](255) NULL,
	[profession] [varchar](255) NULL,
	[custname] [varchar](100) NULL,
	[idtyp] [varchar](10) NULL,
	[idno] [varchar](20) NULL,
	[benfname] [varchar](100) NULL,
	[benfacno] [varchar](36) NULL,
	[benfbank] [varchar](100) NULL,
	[sendbank] [varchar](10) NULL,
	[filldate] [date] NULL,
	[filltime] [varchar](20) NULL,
	[fillusr] [varchar](20) NULL,
	[genusr] [varchar](20) NULL,
	[flag] [varchar](10) NULL,
	[brcd] [int] NULL,
	[brcdx] [varchar](10) NULL,
	[fcn] [varchar](10) NULL,
	[reqby] [int] NULL,
	[bankcd] [varchar](10) NULL,
	[remark] [varchar](255) NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[attendance]    Script Date: 10-02-2025 11:27:50 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[attendance](
	[attendid] [bigint] IDENTITY(1,1) NOT NULL,
	[empid] [bigint] NULL,
	[year] [varchar](20) NULL,
	[month] [varchar](20) NULL,
	[d1] [varchar](80) NULL,
	[d2] [varchar](80) NULL,
	[d3] [varchar](80) NULL,
	[d4] [varchar](80) NULL,
	[d5] [varchar](80) NULL,
	[d6] [varchar](80) NULL,
	[d7] [varchar](80) NULL,
	[d8] [varchar](80) NULL,
	[d9] [varchar](80) NULL,
	[d10] [varchar](80) NULL,
	[d11] [varchar](80) NULL,
	[d12] [varchar](80) NULL,
	[d13] [varchar](80) NULL,
	[d14] [varchar](80) NULL,
	[d15] [varchar](80) NULL,
	[d16] [varchar](80) NULL,
	[d17] [varchar](80) NULL,
	[d18] [varchar](80) NULL,
	[d19] [varchar](80) NULL,
	[d20] [varchar](80) NULL,
	[d21] [varchar](80) NULL,
	[d22] [varchar](80) NULL,
	[d23] [varchar](80) NULL,
	[d24] [varchar](80) NULL,
	[d25] [varchar](80) NULL,
	[d26] [varchar](80) NULL,
	[d27] [varchar](80) NULL,
	[d28] [varchar](80) NULL,
	[d29] [varchar](80) NULL,
	[d30] [varchar](80) NULL,
	[d31] [varchar](80) NULL,
 CONSTRAINT [PK_attendance] PRIMARY KEY CLUSTERED 
(
	[attendid] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[branchmst]    Script Date: 10-02-2025 11:27:50 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[branchmst](
	[brcdx] [varchar](7) NULL,
	[brcd] [int] NULL,
	[brname] [varchar](40) NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[chat]    Script Date: 10-02-2025 11:27:50 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[chat](
	[chatid] [bigint] IDENTITY(1,1) NOT NULL,
	[senderid] [varchar](50) NULL,
	[receiverid] [varchar](50) NULL,
	[message] [varchar](500) NULL,
	[timestamp] [datetime] NULL,
	[chatflag] [int] NULL,
 CONSTRAINT [PK_chat] PRIMARY KEY CLUSTERED 
(
	[chatid] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[cmpinfo]    Script Date: 10-02-2025 11:27:50 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[cmpinfo](
	[cid] [bigint] IDENTITY(1,1) NOT NULL,
	[cmpname] [varchar](50) NULL,
	[cmpemail] [varchar](50) NULL,
	[cmppass] [varchar](50) NULL,
	[ccmail] [varchar](50) NULL,
	[cutofftime] [varchar](50) NULL,
	[hostname] [varchar](50) NULL,
 CONSTRAINT [PK_cmpinfo] PRIMARY KEY CLUSTERED 
(
	[cid] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[compo]    Script Date: 10-02-2025 11:27:50 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[compo](
	[compoid] [bigint] IDENTITY(1,1) NOT NULL,
	[empid] [nchar](10) NULL,
	[compodate] [date] NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[country]    Script Date: 10-02-2025 11:27:50 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[country](
	[cname] [varchar](50) NULL,
	[ccode3] [varchar](5) NOT NULL,
	[flag] [varchar](5) NULL,
	[currency] [varchar](5) NULL,
	[txn] [varchar](5) NULL,
	[addcurrency] [varchar](5) NULL,
	[ccode2] [varchar](5) NULL,
	[phcode] [int] NULL,
	[gcc] [varchar](5) NULL,
	[risk_score] [int] NOT NULL,
	[ccode22] [varchar](5) NULL,
	[moblen] [varchar](10) NULL,
PRIMARY KEY CLUSTERED 
(
	[ccode3] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[DataAccessURLs]    Script Date: 10-02-2025 11:27:50 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[DataAccessURLs](
	[provider] [varchar](50) NULL,
	[typeoffile] [varchar](20) NULL,
	[accesstype] [varchar](3) NULL,
	[accessurl] [varchar](255) NULL,
	[UserID] [varchar](30) NULL,
	[Password] [varchar](30) NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[dcr_arch]    Script Date: 10-02-2025 11:27:50 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[dcr_arch](
	[brcd] [int] NOT NULL,
	[typ] [varchar](20) NULL,
	[subtyp] [varchar](30) NULL,
	[ccode3] [varchar](5) NULL,
	[fcn] [varchar](5) NULL,
	[rowid] [int] IDENTITY(1,1) NOT NULL,
	[jancnt] [int] NULL,
	[janamt] [decimal](18, 3) NULL,
	[febcnt] [int] NULL,
	[febamt] [decimal](18, 3) NULL,
	[marcnt] [int] NULL,
	[maramt] [decimal](18, 3) NULL,
	[aprcnt] [int] NULL,
	[apramt] [decimal](18, 3) NULL,
	[maycnt] [int] NULL,
	[mayamt] [decimal](18, 3) NULL,
	[juncnt] [int] NULL,
	[junamt] [decimal](18, 3) NULL,
	[julcnt] [int] NULL,
	[julamt] [decimal](18, 3) NULL,
	[augcnt] [int] NULL,
	[augamt] [decimal](18, 3) NULL,
	[sepcnt] [int] NULL,
	[sepamt] [decimal](18, 3) NULL,
	[octcnt] [int] NULL,
	[octamt] [decimal](18, 3) NULL,
	[novcnt] [int] NULL,
	[novamt] [decimal](18, 3) NULL,
	[deccnt] [int] NULL,
	[decamt] [decimal](18, 3) NULL,
	[txnyear] [int] NOT NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[emp]    Script Date: 10-02-2025 11:27:50 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[emp](
	[empid] [bigint] IDENTITY(999,1) NOT NULL,
	[username] [varchar](50) NOT NULL,
	[password] [varchar](50) NOT NULL,
	[name] [varchar](50) NULL,
	[dob] [date] NULL,
	[doj] [date] NULL,
	[gender] [varchar](50) NULL,
	[email] [varchar](50) NULL,
	[address] [varchar](150) NULL,
	[mob] [varchar](50) NULL,
	[emptype] [varchar](50) NULL,
	[dojtype] [varchar](50) NULL,
	[designation] [varchar](50) NULL,
	[photo] [varchar](200) NULL,
	[flag] [varchar](50) NULL,
	[salary] [varchar](50) NULL,
	[power] [varchar](50) NULL,
	[empstatus] [varchar](50) NULL,
	[cutoff] [varchar](50) NULL,
	[ip] [varchar](20) NULL,
	[ifsc] [varchar](50) NULL,
	[acc] [varchar](50) NULL,
	[cdate] [date] NULL,
	[qulification] [varchar](50) NULL,
	[exitdate] [date] NULL,
 CONSTRAINT [PK_emp] PRIMARY KEY CLUSTERED 
(
	[empid] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[holiday]    Script Date: 10-02-2025 11:27:50 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[holiday](
	[rowid] [bigint] IDENTITY(1,1) NOT NULL,
	[holiday] [varchar](50) NULL,
	[date] [date] NULL,
 CONSTRAINT [PK_holiday] PRIMARY KEY CLUSTERED 
(
	[rowid] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[infosharing]    Script Date: 10-02-2025 11:27:50 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[infosharing](
	[slno] [int] IDENTITY(1,1) NOT NULL,
	[userid] [varchar](20) NULL,
	[brcd] [int] NULL,
	[typ] [varchar](20) NULL,
	[country] [varchar](20) NULL,
	[product] [varchar](20) NULL,
	[brief] [varchar](255) NULL,
	[narration] [varchar](1023) NULL,
	[entryon] [datetime2](0) NULL,
	[approvedon] [datetime2](0) NULL,
	[approveduser] [varchar](10) NULL,
	[hoaction] [varchar](20) NULL,
 CONSTRAINT [PK__infoshar__32DD162D7075F987] PRIMARY KEY CLUSTERED 
(
	[slno] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[inopcusmaster]    Script Date: 10-02-2025 11:27:50 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[inopcusmaster](
	[idno] [varchar](20) NOT NULL,
	[cusname] [varchar](100) NOT NULL,
	[nation] [varchar](5) NOT NULL,
	[mob] [varchar](36) NOT NULL,
	[brcd] [int] NOT NULL,
	[createdon] [date] NOT NULL,
	[txncount] [int] NOT NULL,
	[txnamt] [decimal](18, 3) NOT NULL,
	[txndate] [date] NOT NULL,
	[reactivedon] [date] NULL,
	[reactivedby] [varchar](20) NOT NULL,
	[followupstat] [varchar](10) NOT NULL,
	[flag] [varchar](5) NOT NULL,
	[fcn] [varchar](5) NOT NULL,
	[followupdate] [date] NULL,
	[followupusr] [varchar](20) NOT NULL,
	[followupbrcd] [int] NOT NULL,
	[hodate] [date] NULL,
	[housr] [varchar](20) NOT NULL,
	[inoptxndate] [date] NULL,
	[reactiveamt] [decimal](18, 3) NULL,
	[txntime] [varchar](16) NOT NULL,
	[followuptime] [varchar](16) NOT NULL,
	[firsttxnamt] [decimal](18, 3) NULL,
	[firsttxnusr] [varchar](20) NULL,
	[firsttxnbrcd] [nchar](10) NULL,
	[firsttxnprod] [varchar](20) NULL,
	[cmpny] [varchar](60) NULL,
 CONSTRAINT [PK_inopcusmaster] PRIMARY KEY CLUSTERED 
(
	[idno] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[inopcusmaster18]    Script Date: 10-02-2025 11:27:50 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[inopcusmaster18](
	[idno] [varchar](20) NOT NULL,
	[cusname] [varchar](100) NOT NULL,
	[nation] [varchar](5) NOT NULL,
	[mob] [varchar](36) NOT NULL,
	[brcd] [int] NOT NULL,
	[createdon] [date] NOT NULL,
	[txncount] [int] NOT NULL,
	[txnamt] [decimal](18, 3) NOT NULL,
	[txndate] [date] NOT NULL,
	[reactivedon] [date] NULL,
	[reactivedby] [varchar](20) NOT NULL,
	[followupstat] [varchar](10) NOT NULL,
	[flag] [varchar](5) NOT NULL,
	[fcn] [varchar](5) NOT NULL,
	[followupdate] [date] NULL,
	[followupusr] [varchar](20) NOT NULL,
	[followupbrcd] [int] NOT NULL,
	[hodate] [date] NULL,
	[housr] [varchar](20) NOT NULL,
	[inoptxndate] [date] NULL,
	[reactiveamt] [decimal](18, 3) NULL,
	[txntime] [varchar](16) NOT NULL,
	[followuptime] [varchar](16) NOT NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[inopfollowup]    Script Date: 10-02-2025 11:27:50 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[inopfollowup](
	[fdate] [date] NOT NULL,
	[code] [varchar](20) NOT NULL,
	[narration] [varchar](200) NULL,
	[ftime] [varchar](16) NOT NULL,
	[userid] [varchar](20) NOT NULL,
	[brcd] [int] NOT NULL,
	[idno] [varchar](20) NOT NULL,
	[homark] [varchar](5) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[fdate] ASC,
	[ftime] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[inopmaster]    Script Date: 10-02-2025 11:27:50 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[inopmaster](
	[typ] [varchar](20) NOT NULL,
	[subtyp] [varchar](20) NOT NULL,
	[remark] [varchar](100) NULL,
	[dayend] [date] NULL,
	[day1] [int] NOT NULL,
	[point] [int] NOT NULL,
	[flag] [varchar](10) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[typ] ASC,
	[subtyp] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[inopsummary]    Script Date: 10-02-2025 11:27:50 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[inopsummary](
	[txndate] [date] NOT NULL,
	[brcd] [int] NOT NULL,
	[typ] [varchar](20) NOT NULL,
	[userid] [varchar](20) NOT NULL,
	[nation] [varchar](5) NOT NULL,
	[fcn] [varchar](5) NOT NULL,
	[total] [int] NOT NULL,
	[contacted] [int] NOT NULL,
	[activated] [int] NOT NULL,
	[point] [int] NOT NULL,
	[autoactv] [int] NOT NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[inopsummary18]    Script Date: 10-02-2025 11:27:50 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[inopsummary18](
	[txndate] [date] NOT NULL,
	[brcd] [int] NOT NULL,
	[typ] [varchar](20) NOT NULL,
	[userid] [varchar](20) NOT NULL,
	[nation] [varchar](5) NOT NULL,
	[fcn] [varchar](5) NOT NULL,
	[total] [int] NOT NULL,
	[contacted] [int] NOT NULL,
	[activated] [int] NOT NULL,
	[point] [int] NOT NULL,
	[autoactv] [int] NOT NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[inoptxn_arch]    Script Date: 10-02-2025 11:27:50 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[inoptxn_arch](
	[idno] [varchar](20) NOT NULL,
	[txnyear] [int] NOT NULL,
	[txncnt] [int] NULL,
	[txnamt] [decimal](18, 3) NULL,
PRIMARY KEY CLUSTERED 
(
	[idno] ASC,
	[txnyear] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[inoptxn_arch18]    Script Date: 10-02-2025 11:27:50 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[inoptxn_arch18](
	[idno] [varchar](20) NOT NULL,
	[txnyear] [int] NOT NULL,
	[txncnt] [int] NULL,
	[txnamt] [decimal](18, 3) NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[leave]    Script Date: 10-02-2025 11:27:50 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[leave](
	[rowid] [bigint] IDENTITY(1,1) NOT NULL,
	[empid] [bigint] NOT NULL,
	[leavecount] [int] NULL,
	[leavebal] [varchar](50) NULL,
	[compodate] [varchar](50) NULL,
	[action] [varchar](50) NULL,
	[leavedate] [date] NULL,
	[attachment] [varchar](500) NULL,
	[reason] [varchar](500) NULL,
	[leavetype] [varchar](50) NULL,
 CONSTRAINT [PK_leave] PRIMARY KEY CLUSTERED 
(
	[rowid] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[leaverequest]    Script Date: 10-02-2025 11:27:50 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[leaverequest](
	[leaverequestid] [bigint] IDENTITY(1,1) NOT NULL,
	[empid] [varchar](50) NULL,
	[leavedate] [date] NULL,
	[compodate] [varchar](50) NULL,
	[reason] [varchar](100) NULL,
	[leavetype] [varchar](50) NULL,
	[time] [datetime] NULL,
	[pending] [varchar](100) NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[msg]    Script Date: 10-02-2025 11:27:50 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[msg](
	[chatid] [bigint] IDENTITY(1,1) NOT NULL,
	[senderid] [varchar](50) NULL,
	[receiverid] [varchar](50) NULL,
	[message] [varchar](8000) NULL,
	[timestamp] [datetime] NULL,
	[isread] [int] NULL,
	[status] [varchar](50) NULL,
	[typing] [char](1) NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tmpattendance]    Script Date: 10-02-2025 11:27:50 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tmpattendance](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[empid] [bigint] NULL,
	[date] [varchar](50) NULL,
	[punchin] [varchar](50) NULL,
	[punchout] [varchar](50) NULL,
	[Reason] [varchar](100) NULL,
	[Approved] [varchar](50) NULL,
 CONSTRAINT [PK_tmpattendance] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[userlogin]    Script Date: 10-02-2025 11:27:50 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[userlogin](
	[usr] [varchar](50) NOT NULL,
	[usrname] [varchar](100) NULL,
	[brcd] [int] NULL,
	[staffno] [bigint] NULL,
PRIMARY KEY CLUSTERED 
(
	[usr] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Index [br]    Script Date: 10-02-2025 11:27:50 ******/
CREATE UNIQUE NONCLUSTERED INDEX [br] ON [dbo].[branchmst]
(
	[brcd] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
SET ANSI_PADDING ON
GO
/****** Object:  Index [brx]    Script Date: 10-02-2025 11:27:50 ******/
CREATE UNIQUE NONCLUSTERED INDEX [brx] ON [dbo].[branchmst]
(
	[brcdx] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
SET ANSI_PADDING ON
GO
/****** Object:  Index [ccc]    Script Date: 10-02-2025 11:27:50 ******/
CREATE NONCLUSTERED INDEX [ccc] ON [dbo].[country]
(
	[ccode3] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
SET ANSI_PADDING ON
GO
/****** Object:  Index [idx_flwdateusr]    Script Date: 10-02-2025 11:27:50 ******/
CREATE NONCLUSTERED INDEX [idx_flwdateusr] ON [dbo].[inopcusmaster]
(
	[followupdate] ASC,
	[followupusr] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [idx_hodate]    Script Date: 10-02-2025 11:27:50 ******/
CREATE NONCLUSTERED INDEX [idx_hodate] ON [dbo].[inopcusmaster]
(
	[hodate] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [idx_lasttxn]    Script Date: 10-02-2025 11:27:50 ******/
CREATE NONCLUSTERED INDEX [idx_lasttxn] ON [dbo].[inopcusmaster]
(
	[txndate] ASC,
	[brcd] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
SET ANSI_PADDING ON
GO
/****** Object:  Index [idx_txnidno]    Script Date: 10-02-2025 11:27:50 ******/
CREATE NONCLUSTERED INDEX [idx_txnidno] ON [dbo].[inopcusmaster]
(
	[txndate] ASC,
	[idno] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
SET ANSI_PADDING ON
GO
/****** Object:  Index [idx_txnmob]    Script Date: 10-02-2025 11:27:50 ******/
CREATE NONCLUSTERED INDEX [idx_txnmob] ON [dbo].[inopcusmaster]
(
	[txndate] ASC,
	[mob] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [fdt]    Script Date: 10-02-2025 11:27:50 ******/
CREATE NONCLUSTERED INDEX [fdt] ON [dbo].[inopfollowup]
(
	[fdate] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
SET ANSI_PADDING ON
GO
/****** Object:  Index [idx_dateid]    Script Date: 10-02-2025 11:27:50 ******/
CREATE NONCLUSTERED INDEX [idx_dateid] ON [dbo].[inopfollowup]
(
	[fdate] ASC,
	[idno] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
SET ANSI_PADDING ON
GO
/****** Object:  Index [idx_idno]    Script Date: 10-02-2025 11:27:50 ******/
CREATE NONCLUSTERED INDEX [idx_idno] ON [dbo].[inopfollowup]
(
	[idno] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
SET ANSI_PADDING ON
GO
/****** Object:  Index [idx_busr]    Script Date: 10-02-2025 11:27:50 ******/
CREATE NONCLUSTERED INDEX [idx_busr] ON [dbo].[inopsummary]
(
	[brcd] ASC,
	[userid] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [idx_tbrcd]    Script Date: 10-02-2025 11:27:50 ******/
CREATE NONCLUSTERED INDEX [idx_tbrcd] ON [dbo].[inopsummary]
(
	[txndate] ASC,
	[brcd] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
SET ANSI_PADDING ON
GO
/****** Object:  Index [idx_tusr]    Script Date: 10-02-2025 11:27:50 ******/
CREATE NONCLUSTERED INDEX [idx_tusr] ON [dbo].[inopsummary]
(
	[txndate] ASC,
	[userid] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
ALTER TABLE [dbo].[country] ADD  CONSTRAINT [DF_country_risk_score]  DEFAULT ((0)) FOR [risk_score]
GO
ALTER TABLE [dbo].[dcr_arch] ADD  CONSTRAINT [df_jan]  DEFAULT ((0)) FOR [jancnt]
GO
ALTER TABLE [dbo].[dcr_arch] ADD  CONSTRAINT [df_janamt]  DEFAULT ((0)) FOR [janamt]
GO
ALTER TABLE [dbo].[dcr_arch] ADD  CONSTRAINT [df_feb]  DEFAULT ((0)) FOR [febcnt]
GO
ALTER TABLE [dbo].[dcr_arch] ADD  CONSTRAINT [df_febamt]  DEFAULT ((0)) FOR [febamt]
GO
ALTER TABLE [dbo].[dcr_arch] ADD  CONSTRAINT [df_mar]  DEFAULT ((0)) FOR [marcnt]
GO
ALTER TABLE [dbo].[dcr_arch] ADD  CONSTRAINT [df_maramt]  DEFAULT ((0)) FOR [maramt]
GO
ALTER TABLE [dbo].[dcr_arch] ADD  CONSTRAINT [df_apr]  DEFAULT ((0)) FOR [aprcnt]
GO
ALTER TABLE [dbo].[dcr_arch] ADD  CONSTRAINT [df_apramt]  DEFAULT ((0)) FOR [apramt]
GO
ALTER TABLE [dbo].[dcr_arch] ADD  CONSTRAINT [df_may]  DEFAULT ((0)) FOR [maycnt]
GO
ALTER TABLE [dbo].[dcr_arch] ADD  CONSTRAINT [df_mayamt]  DEFAULT ((0)) FOR [mayamt]
GO
ALTER TABLE [dbo].[dcr_arch] ADD  CONSTRAINT [df_jun]  DEFAULT ((0)) FOR [juncnt]
GO
ALTER TABLE [dbo].[dcr_arch] ADD  CONSTRAINT [df_junamt]  DEFAULT ((0)) FOR [junamt]
GO
ALTER TABLE [dbo].[dcr_arch] ADD  CONSTRAINT [df_jul]  DEFAULT ((0)) FOR [julcnt]
GO
ALTER TABLE [dbo].[dcr_arch] ADD  CONSTRAINT [df_julamt]  DEFAULT ((0)) FOR [julamt]
GO
ALTER TABLE [dbo].[dcr_arch] ADD  CONSTRAINT [df_aug]  DEFAULT ((0)) FOR [augcnt]
GO
ALTER TABLE [dbo].[dcr_arch] ADD  CONSTRAINT [df_augamt]  DEFAULT ((0)) FOR [augamt]
GO
ALTER TABLE [dbo].[dcr_arch] ADD  CONSTRAINT [df_sep]  DEFAULT ((0)) FOR [sepcnt]
GO
ALTER TABLE [dbo].[dcr_arch] ADD  CONSTRAINT [df_sepamt]  DEFAULT ((0)) FOR [sepamt]
GO
ALTER TABLE [dbo].[dcr_arch] ADD  CONSTRAINT [df_oct]  DEFAULT ((0)) FOR [octcnt]
GO
ALTER TABLE [dbo].[dcr_arch] ADD  CONSTRAINT [df_octamt]  DEFAULT ((0)) FOR [octamt]
GO
ALTER TABLE [dbo].[dcr_arch] ADD  CONSTRAINT [df_nov]  DEFAULT ((0)) FOR [novcnt]
GO
ALTER TABLE [dbo].[dcr_arch] ADD  CONSTRAINT [df_novamt]  DEFAULT ((0)) FOR [novamt]
GO
ALTER TABLE [dbo].[dcr_arch] ADD  CONSTRAINT [df_dec]  DEFAULT ((0)) FOR [deccnt]
GO
ALTER TABLE [dbo].[dcr_arch] ADD  CONSTRAINT [df_decamt]  DEFAULT ((0)) FOR [decamt]
GO
ALTER TABLE [dbo].[inopcusmaster] ADD  DEFAULT ('') FOR [nation]
GO
ALTER TABLE [dbo].[inopcusmaster] ADD  DEFAULT ('') FOR [mob]
GO
ALTER TABLE [dbo].[inopcusmaster] ADD  DEFAULT ((0)) FOR [brcd]
GO
ALTER TABLE [dbo].[inopcusmaster] ADD  DEFAULT ((0)) FOR [txncount]
GO
ALTER TABLE [dbo].[inopcusmaster] ADD  DEFAULT ((0)) FOR [txnamt]
GO
ALTER TABLE [dbo].[inopcusmaster] ADD  DEFAULT ('') FOR [reactivedby]
GO
ALTER TABLE [dbo].[inopcusmaster] ADD  DEFAULT ('') FOR [followupstat]
GO
ALTER TABLE [dbo].[inopcusmaster] ADD  DEFAULT ('') FOR [flag]
GO
ALTER TABLE [dbo].[inopcusmaster] ADD  DEFAULT ('') FOR [fcn]
GO
ALTER TABLE [dbo].[inopcusmaster] ADD  DEFAULT ('') FOR [followupusr]
GO
ALTER TABLE [dbo].[inopcusmaster] ADD  DEFAULT ((0)) FOR [followupbrcd]
GO
ALTER TABLE [dbo].[inopcusmaster] ADD  DEFAULT ('') FOR [housr]
GO
ALTER TABLE [dbo].[inopcusmaster] ADD  DEFAULT ((0)) FOR [reactiveamt]
GO
ALTER TABLE [dbo].[inopcusmaster] ADD  DEFAULT ('00:00:00') FOR [txntime]
GO
ALTER TABLE [dbo].[inopcusmaster] ADD  DEFAULT ('00:00:00') FOR [followuptime]
GO
ALTER TABLE [dbo].[inopfollowup] ADD  DEFAULT ('') FOR [homark]
GO
ALTER TABLE [dbo].[inopmaster] ADD  DEFAULT ((0)) FOR [day1]
GO
ALTER TABLE [dbo].[inopmaster] ADD  DEFAULT ('') FOR [point]
GO
ALTER TABLE [dbo].[inopmaster] ADD  DEFAULT ('') FOR [flag]
GO
ALTER TABLE [dbo].[inopsummary] ADD  DEFAULT ('') FOR [typ]
GO
ALTER TABLE [dbo].[inopsummary] ADD  DEFAULT ('') FOR [userid]
GO
ALTER TABLE [dbo].[inopsummary] ADD  DEFAULT ('') FOR [nation]
GO
ALTER TABLE [dbo].[inopsummary] ADD  DEFAULT ('') FOR [fcn]
GO
ALTER TABLE [dbo].[inopsummary] ADD  DEFAULT ((0)) FOR [total]
GO
ALTER TABLE [dbo].[inopsummary] ADD  DEFAULT ((0)) FOR [contacted]
GO
ALTER TABLE [dbo].[inopsummary] ADD  DEFAULT ((0)) FOR [activated]
GO
ALTER TABLE [dbo].[inopsummary] ADD  DEFAULT ((0)) FOR [point]
GO
ALTER TABLE [dbo].[inopsummary] ADD  DEFAULT ((0)) FOR [autoactv]
GO
ALTER TABLE [dbo].[inoptxn_arch] ADD  DEFAULT ((0)) FOR [txncnt]
GO
ALTER TABLE [dbo].[inoptxn_arch] ADD  DEFAULT ((0)) FOR [txnamt]
GO
ALTER TABLE [dbo].[msg] ADD  DEFAULT ((0)) FOR [isread]
GO
ALTER TABLE [dbo].[msg] ADD  DEFAULT ('N') FOR [typing]
GO
USE [master]
GO
ALTER DATABASE [MISGlobal] SET  READ_WRITE 
GO
